<?php

/**
 * ModuleChatController
 *
 * Define métodos de acesso ao sistema de chat.
 */
class ModuleChatController extends AppController
{
    /**
     * Define os modelos utilizados por este controlador.
     * @var array
     */
    public $uses = array(
        'Chat'
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Chat';
    public $bundle = 'ModulesComunications';

    /**
     * Retorna, no formato json, a lista de chats abertas para/pelo usuário
     * autenticado.
     * @controller-action
     */
    public function getchats() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $chats = array();

        $this->Chat->query('delete from chats '
                          .'where created between \'' . date('Y-m-d H:i:s', 0) . '\' and \'' . date('Y-m-d H:i:s', time() - 60*60*24*2) . '\'');
        
        $new_chats = $this->Chat->query('select `From`.id from chats Chat '
                                   .'inner join users `From` on `From`.id = Chat.`from` '
                                   .'where Chat.`to` = ' . $this->Auth->user('id') . ' '
                                   .'and Chat.`from` != ' . $this->Auth->user('id') . ' '
                                   .'and Chat.created between \'' . date('Y-m-d H:i:s', time() - 15) . '\' and \'' . date('Y-m-d H:i:s') . '\'');

        foreach ( $new_chats as $chat ) {
            $chats[] = array(
                'id' => $chat['From']['id']
            );
        }

        $session_chats = $this->Session->read('Chat');

        if ($session_chats) {
            foreach ( $session_chats as $id => $status ) {
                $chats[] = array(
                    'id' => $id
                );
            }
        }

        echo json_encode($chats);
    }

    /**
     * Retorna, no formato json, a lista de usuários e seus respectivos status.
     * @controller-action
     */
    public function getusers() {
        $this->isAjaxRequest(true);

        $status = $this->Session->read('Chat.users');

        $this->request->data['q'] = isset($this->request->data['q']) ? $this->request->data['q'] : false;
        
        $this->set('status', $status ? $status : 'true');
        $this->set('users', $this->User->query('select User.id, User.name, ifnull(Session.user_id, 0) as Status '
                                              .'from users User '
                                              .'left join sessions Session on User.id = Session.user_id '
                                              .'where User.id != ' . $this->Auth->user('id') . ' '
                                              . ($this->request->data['q'] ?
                                                    'and User.name like \'%' . $this->request->data['q'] . '%\' ' : '')
                                              .'group by User.id, User.name, Session.user_id '
                                              .'order by Session.user_id desc, User.name asc'));
    }

    /**
     * Retorna, no formato json, a lista de mensagens trocadas com um usuário.
     * @controller-action
     */
    public function getmessages($id) {
        $this->isAjaxRequest(true);

        $status = $this->Session->read('Chat.' . $id);

        if ( $status === null ){
            $this->Session->write('Chat.' . $id, 'true');
            $status = 'true';
        }

        $this->set('status', $status);

        $this->set('user', $this->User->query('select User.id, User.name, ifnull(Session.user_id, 0) as Status '
                                              .'from users User '
                                              .'left join sessions Session on User.id = Session.user_id '
                                              .'where User.id = ' . $id . ' '
                                              .'group by User.id, User.name, Session.user_id '));
        
        $this->set('messages', $this->Chat->query('select Chat.content, Chat.created, `From`.id, `From`.name '
                                                 .'from chats Chat '
                                                 .'inner join users `From` on `From`.id = Chat.`from` '
                                                 .'inner join users `To` on `To`.id = Chat.`to` '
                                                 .'where ( '
                                                 .'     Chat.`to` = ' . $this->Auth->user('id') . ' and Chat.`from` = ' . $id . ' '
                                                 .') or ( '
                                                 .'     Chat.`to` = ' . $id . ' and Chat.`from` = ' . $this->Auth->user('id') . ' '
                                                 .') '
                                                 .'order by Chat.created desc '
                                                 .'limit 20 '));
        
        $this->set('me', $this->Auth->user('id'));
    }

    /**
     * Atualiza o status de um chat na sessão do usuário.
     * @controller-action
     */
    public function setstatus($id) {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        if ( $this->request->data['status'] == 'closed' ) {
            $this->Session->delete('Chat.' . $id);
        }else{
            $this->Session->write('Chat.' . $id, $this->request->data['status']);
        }
    }

    public function clear($id) {
        $this->Chat->query('delete from chats '
                          .'where ( '
                          .'     `to` = ' . $this->Auth->user('id') . ' and `from` = ' . $id . ' '
                          .') or ( '
                          .'     `to` = ' . $id . ' and `from` = ' . $this->Auth->user('id') . ' '
                          .')');
        
        $this->request->data['Chat']['to'] = $id;
        $this->request->data['Chat']['from'] = $this->Auth->user('id');
        $this->request->data['Chat']['content'] = '<span style="color: #999;">'
                                                . 'Histórico removido pelo usuário<br>'
                                                . '----------------------------------------'
                                                . '</span>';

        $this->Chat->save($this->request->data);

        $this->autoRender = false;
    }

    /**
     * Envia uma nova mensagem.
     * @controller-action
     */
    public function sendmessage($id) {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $this->request->data['Chat']['to'] = $id;
        $this->request->data['Chat']['from'] = $this->Auth->user('id');
        $this->request->data['Chat']['content'] = wordwrap($this->request->data['content'], 27, "\n", true);

        $this->Chat->save($this->request->data);
    }

}

?>
<?php

/**
 * ModuleMessagesController
 *
 * Controlador responsável pelo sistema de mensagens. Permite enviar e gerenciar
 * as mensagens do usuário autenticado.
 */
class ModuleMessagesController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'User',
        'Message'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Message.created' => 'desc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Messages';
    public $bundle = 'ModulesComunications';

    /**
     * Configura a listagem de mensagens para exibir qualquer mensagem enviada ou
     * recebida pelo usuário autenticado.
     */
    public function inbox() {
        $this->paginate['conditions']['or']['Message.to'] = $this->Auth->user('id');
        $this->paginate['conditions']['or']['Message.from'] = $this->Auth->user('id');
    }

    /**
     * Configura a listagem de mensagens para exibir apenas mensagens enviadas
     * pelo usuário autenticado.
     */
    public function sended() {
        $this->paginate['conditions']['and']['Message.from'] = $this->Auth->user('id');
    }

    /**
     * Configura a listagem de mensagens para exibir apenas mensagens recebidas
     * pelo usuário autenticado.
     */
    public function received() {
        $this->paginate['conditions']['and']['Message.to'] = $this->Auth->user('id');
    }

    /**
     * Lista as mensagens do usuário autenticado. Opcionalmente filtra apenas as
     * mensagens enviadas ou recebidas.
     * @controller-action
     */
    public function index($type) {
        $this->Message->recursive = 1;

        if ( ! in_array($type, array('inbox', 'sended', 'received'))) {
            throw new NotFoundException();
        }

        $this->setSearch('Message', array(
            'de'      => 'From.name',
            'para'    => 'To.name',
            'assunto' => 'Message.subject',
            'data'    => array('Message.created', 'date'),
            'conteudo'=> 'Message.content'
        ));

        $this->{$type}();

        $this->set('title', 'Módulos > Mensagens');
        $this->set('messages', $this->paginate('Message'));
    }

    /**
     * Método responsável por exibir detalhes sobre uma mensagem enviada pelo
     * sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Message->id = $id;
        $this->Message->recursive = 1;

        $messages = $this->Message->read(null, $id);

        if ( ! $messages) {
            throw new NotFoundException();
        }

        $this->set('messages', $messages);

        if ($messages['Message']['to'] == $this->Auth->user('id')) {
            $this->Message->id = $id;
            $this->Message->save(array('readed' => 1));
        }
    }

    /**
     * Método responsável por criar uma nova mensagem. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            $this->request->data['Message']['readed'] = 0;
            $this->request->data['Message']['from'] = $this->Auth->user('id');

            if ($this->Message->saveAll($this->request->data)) {
                $this->set('success', true);
            }

            if (isset($this->Message->validationErrors['to'])) {
                $this->Message->validationErrors['to_name'] = $this->Message->validationErrors['to'];
            }
        }
    }

    /**
     * Método responsável por popular as sugestões do campo to.
     * @controller-action
     */
    public function users() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->User->find('list', array(
            'conditions' => array(
                'User.id !=' => $this->Auth->user('id'),
                'User.name like' => '%' . $q . '%'
            )
        )));
    }

}

?>
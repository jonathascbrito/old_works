<?php

/**
 * Registra a classe controller.
 */
App::uses('Permission', 'Model');
App::uses('Controller', 'Controller');

/**
 * AppController
 *
 * Define métodos de acesso ao sistema (login, logout, reset) e funcionalidades
 * comuns a todos os controladores.
 */
class AppController extends Controller
{

    /**
     * Define o layout utilizado. Por padrão 'authenticated'. Caso o usuário não
     * esteja logado o layout será alterado para 'anonymous' antes de renderizar
     * a view.
     * @var string
     */
    public $layout = 'authenticated';

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = '';
    public $bundle = 'App';

    /**
     * Define os modelos utilizados por este controlador.
     * @var array
     */
    public $uses = array(
        'User',
        'Permission'
    );

    /**
     * Define os componentes utilizados pelo controlador e configura o componente
     * Auth, definindo o controlador, método e endereços de login, logout etc.
     * @var array
     */
    public $components = array(
        'Session',
        'RequestHandler',

        'Auth' => array(
            'loginAction' => '/login',

            'loginRedirect' => '/modules/messages/inbox',
            'logoutRedirect' => '/',

            'authorize' => 'Controller',
            'authenticate' => array(
                'Form' => array(
                    'scope' => array('User.active' => '1')
                )
            ),

            'authError' => 'Você não está autorizado a acessar a página solicitada!',
        )
    );

    /**
     * Método executado automaticamente pelo componente 'Auth'. Retorna um valor
     * booleano indicando se o usuário tem permissão para acessar a página
     * solicitada.
     *
     * @param array $user
     * @return boolean
     */
    public function isAuthorized( $user ) {
        if ( $this->hasPermission( "{$this->name} {$this->action}" ) ) {
            return true;
        }

        return false;
    }

    protected function hasPermission( $action ) {
        $id = (int) $this->Auth->user('id');

        if ($id == 1) {
            return true;
        }

        $permissions = false;
        //$permissions = $this->Session->read('permissions');

        if( ! $permissions ) {
            $permissions = $this->Permission->query( "SELECT permissions.action FROM permissions "
                                                   . "INNER JOIN roles_permissions rp ON rp.permission_id = permissions.id "
                                                   . "INNER JOIN users_roles ur ON ur.role_id = rp.role_id "
                                                   . "WHERE ur.user_id = {$id} "
                                                   . "GROUP BY permissions.action " );

            $permissions = $permissions ? $permissions : array();

            for($p=0; $p<count($permissions); $p++){
                $permissions[$p] = $permissions[$p]['permissions']['action'];
            }

            $permissions[] = 'ModuleMessages index';
            $permissions[] = 'Attachments upload';
            $permissions[] = 'Attachments download';

            $permissions[] = 'App handle_update';
            $permissions[] = 'App handle_delete';

            $this->Session->write('permissions', $permissions);
        }

        return in_array( $action, $permissions, true );
    }

    /**
     * Verifica se o método utilizado na requisição é do tipo especificado pelo
     * parâmetro $method.
     *
     * @param string $method
     * @return boolean
     */
    protected function isMethod($method) {
        return strtolower($this->request->method()) == strtolower($method);
    }

    /**
     * Verifica se a requisição foi feita utilizando javascript e opcionalmente
     * lança uma exceção do tipo 'MethodNotAllowedException' caso a verificação
     * retorne falso.
     *
     * @param boolean $throws
     * @return boolean
     *
     * @throws MethodNotAllowedException
     */
    protected function isAjaxRequest($throws = false) {
        if ($this->request->is('ajax')) return true;
        if ($throws) throw new MethodNotAllowedException();

        return false;
    }

    /**
     * Configura uma nova mensagem informativa, alerta ou erro na sessão. A
     * mensagem será exibida apenas nesta requisição.
     *
     * @param string $type
     * @param string $message
     * @param string $context
     */
    protected function setMessage( $type, $message, $context = null ) {
        $this->Session->setFlash( $message, "message-$type", null, $context );
    }

    /**
     * Configura uma nova busca no modelo especificado. A busca ficará limitada
     * aos campos especificados em $fields.
     *
     * @param string $model
     * @param array $fields
     */
    protected function setSearch( $model, $fields ) {
        $query = isset($this->request->data[$model]['search']) ?
                       $this->request->data[$model]['search'] : false;

        if ($query !== false) {
            $conditions = array();
            $matches = preg_match_all('|(?<field>[\p{L}]+):(?<value>.+[ ])|siuU', $query . ' ', $queries);

            if ( $matches ) {
                for ($m=0; $m < $matches; $m++) {
                    $field = trim($queries['field'][$m]);
                    $value = trim(mb_strtoupper($queries['value'][$m]));

                    if (is_array($fields[$field])) {
                        $format = $fields[$field][1];
                        $fields[$field] = $fields[$field][0];
                    }

                    if (isset($format)) {
                        switch ($format) {
                            case 'date' :
                                $value =  explode('/', $value);
                                $value = array_reverse($value);
                                $value = implode('-', $value);
                        }
                    }

                    if (isset($fields[$field])) {
                        $conditions['upper(' . $fields[$field] . ') like '] = '%' . $value . '%';
                    }
                }
            }

            if ( ! $matches ) {
                $query = mb_strtoupper($query);

                foreach ($fields as $field) {
                    $conditions['or']['upper(' . $field . ') like '] = '%' . $query . '%';
                }
            }

            $this->paginate['conditions']['and'][] = $conditions;
        }
    }

    /**
     * Método executado antes que qualquer ação do controlador seja disparada.
     * Libera o acesso as páginas login, logout e reset e verifica se o usuário
     * está logado redirecionando-o para o dashboard caso as páginas login ou
     * reset sejam acessadas.
     */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow(array('login', 'logout', 'reset'));

        if ($this->Auth->loggedIn() and ($this->action == 'login' or $this->action == 'reset')) {
            $this->redirect('/modules/messages/inbox');
        }

        $this->layout = $this->Auth->user('id') ? 'authenticated' : 'anonymous';
    }

    /**
     * Método executado antes que qualquer página seja renderizada. Configura o
     * caminho das views de acordo com o pacote e o módulo do controlador.
     */
    public function beforeRender() {
        parent::beforeRender();

        $this->viewPath = 'Bundles/'
                        . ( $this->bundle ? $this->bundle . '/' : '' )
                        . ( $this->path ? $this->path : '' );
    }

    /**
     * Verifica se pelo menos um dos itens foir selecionado para alteração e
     * redireciona para o método adequado.
     * @controller-action
     */
    public function handle_update($controller) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            $ids = array();

            if (isset($this->request->data['toggle'])) {
                $ids = array_keys(array_filter($this->request->data['toggle']));
            }

            if (count($ids) === 1) {
                $this->redirect(array(
                    'controller' => $controller,
                    'action' => 'update',
                    $ids[0]
                ));
            }
        }
    }

    /**
     * Verifica se pelo menos um dos itens foir selecionado para remoção e
     * redireciona para o método adequado.
     * @controller-action
     */
    public function handle_delete($controller) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            $ids = array();

            if (isset($this->request->data['toggle'])) {
                $ids = array_keys(array_filter($this->request->data['toggle']));
            }

            if (count($ids) === 1) {
                $this->redirect(array(
                    'controller' => $controller,
                    'action' => 'delete',
                    $ids[0]
                ));
            }
        }
    }

    /**
     * Realiza o login do usuário no sistema.
     * @controller-action
     */
    public function login() {
        if ($this->isMethod('post')) {

            if ( $this->Auth->login() ) :
                return $this->redirect($this->Auth->redirect());
            endif;

            $this->setMessage('error', 'Usuário ou senha inválidos! '
                                     . 'Por favor, tente novamente.', 'auth');
        }

        $this->set('title', 'Login');
    }

    /**
     * Realiza o logout do usuário no sistema.
     * @controller-action
     */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    /**
     * Reseta a conta do usuário enviando seu usuário e a nova senha para o
     * endereço de e-mail cadastrado.
     * @controller-action
     */
    public function reset() {
        $this->set('title', 'Recuperar Conta');

        if ($this->isMethod('post')) {
            $addr = $this->request->data['User']['email'];
            $user = $this->User->findByEmail($addr);

            if ( ! $user) {
                $this->setMessage('error', 'O e-mail informado não está vinculado a nenhum usuário!', 'auth');
                return;
            }

            $this->User->id = $user['User']['id'];

            if ( ! $this->User->generatePassword(true, 'Recuperar Conta', 'resetuser')) {
                $this->setMessage('error', 'Houve um problema ao redefinir a conta! '
                                         . 'Entre em contato com a equipe de suporte.', 'auth');
                return;
            }

            $this->setMessage('success', 'Sua conta foi redefinida! '
                                       . 'Em alguns instantes você receberá um e-mail com instruções para acessá-la.', 'auth');

            //@todo: implementar um contador de resets para evitar ataques DOS
        }
    }

}

?>
<?php

/**
 * ModuleUsersController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os usuários
 * da aplicação.
 */
class ModuleUsersController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'User',
        'Role'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'User.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Users';
    public $bundle = 'ModulesUsers';

    /**
     * Lista os usuários do sistema.
     * @controller-action
     */
    public function index() {
        $this->User->recursive = 1;

        $this->setSearch('User', array(
            'nome'    => 'User.name',
            'email'   => 'User.email',
            'usuário' => 'User.username',
            'status'  => 'User.active'
        ));

        $this->set('title', 'Módulos > Usuários');
        $this->set('users', $this->paginate('User'));
    }

    /**
     * Método responsável por exibir detalhes sobre um usuário previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->User->id = $id;
        $this->User->recursive = 1;

        $user = $this->User->read(null, $id);

        if ( ! $user) {
            throw new NotFoundException();
        }

        $this->set('user', $user);
    }

    /**
     * Método responsável por criar um novo usuário. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            $this->request->data['User']['password'] = 'temp';
            $user = $this->User->saveAll($this->request->data);

            if ($user and $this->User->generatePassword(true, 'Bem vindo(a)!', 'newuser')) {
                $this->set('success', true);
            }
        }

        $this->set('roles', $this->Role->find('list'));
    }

    /**
     * Método responsável por editar um usuário já cadastrado. Exibe o formulário
     * preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($id == 1) {
            throw new UnauthorizedException();
        }

        if ($this->isMethod('get')) {
            $this->User->id = $id;
            $this->User->recursive = 1;

            $user = $this->User->read(null, $id);

            if ( ! $user) {
                throw new NotFoundException();
            }

            $this->request->data = $user;
        }

        if ($this->isMethod('put')) {
            unset($this->request->data['User']['password']);

            if ($this->User->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
        $this->set('roles', $this->Role->find('list'));
    }

    /**
     * Método responsável por apagar um usuário já cadastrado. Exibe um alerta
     * para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        if ($id == 1) {
            throw new UnauthorizedException();
        }

        $user = $this->User->read(null, $id);

        if ( ! $user) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('user', $user);

        if ($this->isMethod('delete')) {
            if ($this->User->delete($id)) {
                $this->set('success', true);
            }
        }
    }
}

?>
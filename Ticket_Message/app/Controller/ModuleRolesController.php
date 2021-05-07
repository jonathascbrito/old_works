<?php

/**
 * ModuleRolesController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os perfis
 * da aplicação.
 */
class ModuleRolesController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
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
            'Role.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Roles';
    public $bundle = 'ModulesUsers';

    /**
     * Lista os perfis do sistema.
     * @controller-action
     */
    public function index() {
        $this->Role->recursive = 1;

        $this->setSearch('Role', array(
            'nome'      => 'Role.name',
            'descrição' => 'Role.description'
        ));

        $this->set('title', 'Módulos > Usuários > Perfis');
        $this->set('roles', $this->paginate('Role'));
    }

    /**
     * Método responsável por exibir detalhes sobre um perfil previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Role->id = $id;
        $this->Role->recursive = 2;

        $role = $this->Role->read(null, $id);

        if ( ! $role) {
            throw new NotFoundException();
        }

        $this->set('role', $role);
    }

    /**
     * Método responsável por criar um novo perfil. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->Role->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
    }

    /**
     * Método responsável por editar um perfil já cadastrado. Exibe o formulário
     * preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('get')) {
            $this->Role->id = $id;

            $role = $this->Role->read(null, $id);

            if ( ! $role) {
                throw new NotFoundException();
            }

            $this->request->data = $role;
        }

        if ($this->isMethod('put')) {
            if ($this->Role->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
    }

    /**
     * Método responsável por apagar um perfil já cadastrado. Exibe um alerta
     * para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        $role = $this->Role->read(null, $id);

        if ( ! $role) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('role', $role);

        if ($this->isMethod('delete')) {
            if ($this->Role->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
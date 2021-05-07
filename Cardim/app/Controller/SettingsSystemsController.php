<?php

/**
 * ModuleSystemController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os perfis
 * da aplicação.
 */
class SettingsSystemsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'System',
        'Entity'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'System.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Systems';
    public $bundle = 'SettingsSystem';

    /**
     * Lista os perfis do sistema.
     * @controller-action
     */
    public function index() {
        $this->System->recursive = 1;

        $this->setSearch('System', array(
            'nome'      => 'System.name',
            'descrição' => 'System.description'
        ));

        $this->set('title', 'Configurações > Sistemas/Equipamentos');
        $this->set('systems', $this->paginate('System'));
    }

    /**
     * Método responsável por exibir detalhes sobre um perfil previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->System->id = $id;
        $this->System->recursive = 2;

        $system = $this->System->read(null, $id);

        if ( ! $system) {
            throw new NotFoundException();
        }

        $this->set('system', $system);
    }

    /**
     * Método responsável por criar um novo perfil. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->System->saveAll($this->request->data)) {
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
            $this->System->id = $id;

            $system = $this->System->read(null, $id);

            if ( ! $system) {
                throw new NotFoundException();
            }

            $this->request->data = $system;
        }

        if ($this->isMethod('put')) {
            if ($this->System->saveAll($this->request->data)) {
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

        $system = $this->System->read(null, $id);

        if ( ! $system) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('system', $system);

        if ($this->isMethod('delete')) {
            if ($this->System->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
<?php

/**
 * ModuleHelpdeskTypesController
 *
 * Controlador responsável pelo módulo Helpdesk. Permite gerenciar os tipos de
 * tickets.
 */
class SettingsTypesController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'TicketType'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'TicketType.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'TicketsTypes';
    public $bundle = 'SettingsSystem';

    /**
     * Lista os perfis do sistema.
     * @controller-action
     */
    public function index() {
        $this->TicketType->recursive = 1;

        $this->setSearch('TicketType', array(
            'nome'      => 'TicketType.name',
            'descrição' => 'TicketType.description'
        ));

        $this->set('title', 'Configurações > Tipos de Chamados');
        $this->set('types', $this->paginate('TicketType'));
    }

    /**
     * Método responsável por exibir detalhes sobre um perfil previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Role->id = $id;
        $this->Role->recursive = 1;

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
            if ($this->TicketType->saveAll($this->request->data)) {
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
            $this->TicketType->id = $id;

            $type = $this->TicketType->read(null, $id);

            if ( ! $type) {
                throw new NotFoundException();
            }

            $this->request->data = $type;
        }

        if ($this->isMethod('put')) {
            if ($this->TicketType->saveAll($this->request->data)) {
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

        $type = $this->TicketType->read(null, $id);

        if ( ! $type) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('type', $type);

        if ($this->isMethod('delete')) {
            if ($this->TicketType->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
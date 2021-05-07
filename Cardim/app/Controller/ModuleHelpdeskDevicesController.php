<?php

/**
 * ModuleHelpdeskDevicesController
 *
 * Controlador responsável pelo módulo Helpdesk. Permite gerenciar os
 * equipamentos cadastrados.
 */
class ModuleHelpdeskDevicesController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'TicketDevice'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'TicketDevice.type' => 'asc',
            'TicketDevice.code' => 'asc',
            'TicketDevice.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'TicketsDevices';
    public $bundle = 'ModulesHelpdesk';

    /**
     * Lista os perfis do sistema.
     * @controller-action
     */
    public function index() {
        $this->TicketDevice->recursive = 1;

        $this->setSearch('TicketDevice', array(
            'tipo'      => 'TicketDevice.type',
            'código'    => 'TicketDevice.code',
            'nome'      => 'TicketDevice.name'
        ));

        $this->set('title', 'Módulos > Ordens de Serviço > Sistemas');
        $this->set('devices', $this->paginate('TicketDevice'));
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
            if ($this->TicketDevice->saveAll($this->request->data)) {
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
            $this->TicketDevice->id = $id;

            $device = $this->TicketDevice->read(null, $id);

            if ( ! $device) {
                throw new NotFoundException();
            }

            $this->request->data = $device;
        }

        if ($this->isMethod('put')) {
            if ($this->TicketDevice->saveAll($this->request->data)) {
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

        $device = $this->TicketDevice->read(null, $id);

        if ( ! $device) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('device', $device);

        if ($this->isMethod('delete')) {
            if ($this->TicketDevice->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
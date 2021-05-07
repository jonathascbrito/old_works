<?php

/**
 * ModuleHelpdeskController
 *
 * Controlador responsável pelo sistema de helpdesk. Permite gerenciar os
 * chamados recebidos e enviados.
 */
class ModuleHelpdeskController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Ticket',
        'TicketType',
        'TicketDevice',
        'Messages'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Ticket.code_year' => 'desc',
            'Ticket.code_number' => 'desc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Tickets';
    public $bundle = 'ModulesHelpdesk';

    /**
     * Lista os tickets do sistema.
     * @controller-action
     */
    public function index() {
        $this->Ticket->recursive = 1;

        $this->setSearch('Ticket', array(
            'solicitante'=> 'User.name',
            'tipo'       => 'Type.name',
            'equipamento'=> 'Device.name',
            'status'     => 'Ticket.status'
        ));

		if ( ! $this->hasPermission('ModuleHelpdesk answer')) {
			$this->paginate['conditions']['and'] = array(
				'Ticket.user_id' => $this->Auth->user('id')
			);
		}
		
        $this->set('title', 'Módulos > Helpdesk');
        $this->set('tickets', $this->paginate('Ticket'));
    }

    /**
     * Método responsável por exibir detalhes sobre um protocolo previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Protocol->id = $id;
        $this->Protocol->recursive = 1;

        $protocol = $this->Protocol->read(null, $id);

        if ( ! $protocol) {
            throw new NotFoundException();
        }

        $this->set('protocol', $protocol);
    }

    /**
     * Método responsável por criar um novo protocolo. Exibe um formulário ou
     * uma mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->request->data['Ticket']['user_id'] == '') {
                $this->request->data['Ticket']['user_id'] = $this->Auth->user('id');
            }

            $this->request->data['Ticket']['status'] = 'Aberto';

            if ($this->Ticket->saveAll($this->request->data)) {
                $this->set('success', true);
            }

            if (isset($this->Ticket->validationErrors['user_id'])) {
                $this->Ticket->validationErrors['user_id_name'] = $this->Ticket->validationErrors['user_id'];
            }

            if (isset($this->Ticket->validationErrors['ticket_type_id'])) {
                $this->Ticket->validationErrors['ticket_type_id_name'] = $this->Ticket->validationErrors['ticket_type_id'];
            }

            if (isset($this->Ticket->validationErrors['ticket_device_id'])) {
                $this->Ticket->validationErrors['ticket_device_id_name'] = $this->Ticket->validationErrors['ticket_device_id'];
            }
            
        }
    }

    /**
     * Método responsável por popular as sugestões do campo user.
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
                'User.name like' => '%' . $q . '%'
            )
        )));
    }

    /**
     * Método responsável por popular as sugestões do campo type.
     * @controller-action
     */
    public function types() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        echo json_encode($this->TicketType->find('list', array(
            'fields' => array('TicketType.id', 'TicketType.qualified_name'),
            'conditions' => array(
                'TicketType.name like' => '%' . $q . '%',
                'TicketType.description like' => '%' . $q . '%'
            )
        )));
    }


    /**
     * Método responsável por popular as sugestões do campo device.
     * @controller-action
     */
    public function devices() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        echo json_encode($this->TicketDevice->find('list', array(
            'fields' => array(
                'TicketDevice.id',
                'TicketDevice.qualified_name'
            ),
            'conditions' => array(
                'or' => array(
                    'TicketDevice.type like' => '%' . $q . '%',
                    'TicketDevice.code like' => '%' . $q . '%',
                    'TicketDevice.name like' => '%' . $q . '%'
                )
            )
        )));
    }

}

?>
<?php

/**
 * ModuleEntitiesController
 *
 * Controlador responsável pelo sistema de entidades. Permite gerenciar as entidades
 * da aplicação.
 */
class ModuleResultsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Entity',
        'Contract',
        'Ticket'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Entity.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Results';
    public $bundle = 'ModulesResults';

    /**
     * Lista as entidades do sistema.
     * @controller-action
     */
    public function index() {
        $this->Entity->recursive = 1;

        $this->setSearch('Entity', array(
            'nome'                    => 'Entity.name',
            'email'                   => 'Entity.email',
            'telefone'                => 'Entity.phone',
            'celular'                 => 'Entity.cellphone',
            'endereço'                => 'Entity.address',
            'contact'                 => 'Entity.contact'
        ));

        $this->set('title', 'Módulos > Relatórios');
        $this->set('entities', $this->paginate('Entity'));
    }

    /**
     * Método responsável por exibir detalhes sobre uma entidade previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Entity->id = $id;
        $this->Entity->recursive = 1;

        $entity = $this->Entity->read(null, $id);

        if ( ! $entity) {
            throw new NotFoundException();
        }
        
                    //$contract = $this->Contract->read(null, $id);
            //$entity_id = $contract['Contract']['entity_id'];
            //$this->Entity->recursive = 1;
            //$entity = $this->Entity->read(null, $entity_id);

            //$this->set('entity', $entity);
        
            $contract = $this->Contract->find('all', array( 
                'fields' => array('Contract.id', 'Contract.service', 'Contract.date'),
                'conditions' => array( 'Contract.entity_id like' => $id)
                        ));
            
            $ticket = $this->Ticket->find('all', array(
                    'fields' => array('Ticket.id', 'Ticket.code_number', 'Ticket.code_year'),
                    'conditions' => array( 'Ticket.entity_id like' => $id)
                    ));

            $this->set('contracts', $contract);
            $this->set('tickets', $ticket);

            $this->set('entity', $entity);
    }


}

?>
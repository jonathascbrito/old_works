<?php
App::uses('AppController', 'Controller');

class ContractsController extends AppController
{

    public $name = 'Contracts';
	public $uses = array
    (
        'Contract',
        'ContractPeriod',
        'ContractValue',
        'BudgetAccount',
        'ResultsCenter',
        'Entity'
    );

    public $paginate = array
    (
        'limit' => 25,
        'order' => array
        (
            'id' => 'desc'
        )
    );

    public function __construct($request = null, $response = null) {
        parent::__construct( $request, $response );
        parent::auth( );
    }

    public function setResources ( )
    {
        $this->set( 'entities', $this->Entity->find
            (
                "list",
                array
                (
                    "recursive"     => 1,
                    "fields"        => array('Entity.id', 'Entity.name', 'Entity.type'),
                    "order"         => array('Entity.name asc'),
                    "conditions"    => array
                    (
                        "Entity.client = 1"
                    )
                )
            )
        );

        $this->set( 'resultsCenters', $this->ResultsCenter->find
            (
                "analytic",
                array
                (
                    "recursive"     => 1,
                    "fields"        => array('ResultsCenter.id', 'ResultsCenter.qualified_name'),
                    "order"         => array('ResultsCenter.code asc'),
                    "level"         => Configure::read('Mvtl.Contracts.ResultsCenterAnalyticLevel')
                )
            )
        );

        $this->set( 'budgetAccounts', $this->BudgetAccount->find
            (
                "analytic",
                array
                (
                    "recursive"     => 1,
                    "fields"        => array('BudgetAccount.id', 'BudgetAccount.qualified_name'),
                    "order"         => array('BudgetAccount.code asc'),
                    "level"         => Configure::read('Mvtl.Contracts.BudgetAccountAnalyticLevel')
                )
            )
        );
    }

    public function add ( )
    {
        $this->set( 'controller_name', 'Contratos' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            if( ! isset($this->request->data['ContractValue'][0]['part']) )
                $this->request->data['ContractValue'][0]['part'] = "0";

            $this->request->data['ContractValue'][0]['part_percent'] =
                strstr($this->request->data['ContractValue'][0]['part'], "%");

            $this->request->data['ContractValue'][0]['base'] =
                str_replace
                (
                    array(".", ","), array("", "."),
                    $this->request->data['ContractValue'][0]['base']
                );

            $this->request->data['ContractValue'][0]['part'] =
                str_replace
                (
                    array(".", ","), array("", "."),
                    $this->request->data['ContractValue'][0]['part']
                );

            $this->request->data['ContractPeriod'][0]['billingdate'] =
                $this->request->data['ContractPeriod'][0]['billingdate']['day'];

            $this->request->data['ContractPeriod'][0]['duedate'] =
                $this->request->data['ContractPeriod'][0]['duedate']['day'];

            parent::save
            (
                "Contract",
                "Novo contrato salvo com sucesso!",
                "Houve um problema ao salvar o contrato!"
            );
        }

        $this->setResources( );
        $this->render( 'form' );
    }

    public function view ( $id )
    {
        $this->set( 'controller_name', 'Contratos' );
        $this->set( 'controller_action', 'Detalhes' );

        $this->Contract->id = $id;
        $this->set('contract', $this->Contract->read());

        $this->render('Details');
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Contratos' );
        $this->set( 'controller_action', 'Listar' );

        $this->set('contracts', $this->paginate('Contract'));
        $this->render('Index');
    }

}

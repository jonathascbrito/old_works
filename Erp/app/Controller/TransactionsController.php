<?php
App::uses('AppController', 'Controller');

class TransactionsController  extends AppController
{

    public $name = 'Transactions';
	public $uses = array
    (
        'Transaction',
        'TransactionResultsCenter',
        'TransactionPayment',
        'BudgetAccount',
        'ResultsCenter',
        'Entity'
    );

    public $paginate = array
    (
        'limit' => 25,
        'order' => array
        (
            'duedate' => 'asc'
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
                    "order"         => array('Entity.name asc')
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
                    "level"         => Configure::read('Mvtl.Transactions.ResultsCenterAnalyticLevel')
                )
            )
        );

        $this->set( 'budgetAccountsIn', $this->BudgetAccount->find
            (
                "analytic",
                array
                (
                    "recursive"     => 1,
                    "fields"        => array('BudgetAccount.id', 'BudgetAccount.qualified_name'),
                    "order"         => array('BudgetAccount.code asc'),
                    "level"         => Configure::read('Mvtl.Transactions.In.BudgetAccountAnalyticLevel')
                )
            )
        );

        $this->set( 'budgetAccountsOut', $this->BudgetAccount->find
            (
                "analytic",
                array
                (
                    "recursive"     => 1,
                    "fields"        => array('BudgetAccount.id', 'BudgetAccount.qualified_name'),
                    "order"         => array('BudgetAccount.code asc'),
                    "level"         => Configure::read('Mvtl.Transactions.Out.BudgetAccountAnalyticLevel')
                )
            )
        );
    }

    public function add ( )
    {
        $this->set( 'controller_name', 'Movimentações' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            if ( $this->request->data['Transaction']['type'] == 'Saída' )
            {
                $this->request->data['Transaction']['budget_account_id'] =
                    $this->request->data['Transaction']['budget_account_id_out'];
            }else{
                $this->request->data['Transaction']['budget_account_id'] =
                    $this->request->data['Transaction']['budget_account_id_in'];
            }

            parent::save
            (
                "Transaction",
                "Novo movimento salvo com sucesso!",
                "Houve um problema ao salvar o movimento!"
            );
        }

        $this->setResources( );
        $this->render( 'form' );
    }

    public function view ( $id )
    {
        $this->set( 'controller_name', 'Movimentações' );
        $this->set( 'controller_action', 'Detalhes' );

        $this->Transaction->id = $id;
        $this->set('transaction', $this->Transaction->find
            (
                'first',
                array
                (
                    'conditions'=> array
                    (
                        'Transaction.id' => $id
                    ),
                    'recursive' => 2
                )
            )
        );

        $this->render('Details');
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Movimentações' );
        $this->set( 'controller_action', 'Listar' );

        $this->set('transactions', $this->paginate('Transaction'));
        $this->render('Index');
    }

}

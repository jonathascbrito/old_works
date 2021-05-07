<?php
App::uses('AppController', 'Controller');

class BudgetAccountsController extends AppController
{

    public $name = 'BudgetAccounts';
	public $uses = array
    (
        'BudgetAccount'
    );

    public $paginate = array
    (
        'limit' => 1000,
        'order' => array
        (
            'code' => 'asc'
        )
    );

    public function __construct($request = null, $response = null) {
        parent::__construct( $request, $response );
        parent::auth( );
    }

    public function add ( )
    {
        $this->set( 'controller_name', 'Contas Orçamentárias' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "BudgetAccount",
                "Nova conta orçamentária salva com sucesso!",
                "Houve um problema ao salvar a conta orçamentária!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Contas Orçamentárias' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "BudgetAccount",
                "Conta orçamentária salva com sucesso!",
                "Houve um problema ao salvar a conta orçamentária!"
            );
        }else{
            $this->BudgetAccount->id = $id;
            $this->request->data = $this->BudgetAccount->read();
        }

        $this->set( 'id', $id );
        $this->render( 'form' );
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Contas Orçamentárias' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "BudgetAccount.code LIKE" => "%{$terms}%",
                    "BudgetAccount.name LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('budgetAccounts', $this->paginate('BudgetAccount'));
        $this->render('Index');
    }

    public function delete ( $id )
    {
        $this->BudgetAccount->delete( $id );
        $this->redirect( array( 'action' => 'index' ) );
    }

}
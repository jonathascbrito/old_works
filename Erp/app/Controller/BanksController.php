<?php
App::uses('AppController', 'Controller');

class BanksController extends AppController
{

    public $name = 'Banks';
	public $uses = array
    (
        'Bank'
    );

    public $paginate = array
    (
        'limit' => 25,
        'order' => array
        (
            'name' => 'asc'
        )
    );

    public function __construct($request = null, $response = null) {
        parent::__construct( $request, $response );
        parent::auth( );
    }

    public function add ( )
    {
        $this->set( 'controller_name', 'Bancos' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Bank",
                "Novo banco salvo com sucesso!",
                "Houve um problema ao salvar o banco!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Bancos' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Bank",
                "Novo banco salvo com sucesso!",
                "Houve um problema ao salvar o banco!"
            );
        }else{
            $this->Bank->id = $id;
            $this->request->data = $this->Bank->read();
        }

        $this->set( 'id', $id );
        $this->render('Form');
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Bancos' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Bank.name LIKE" => "%{$terms}%",
                    "Bank.bank LIKE" => "%{$terms}%",
                    "Bank.bank_name LIKE" => "%{$terms}%",
                    "Bank.agency LIKE" => "%{$terms}%",
                    "Bank.account LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('banks', $this->paginate('Bank'));
        $this->render('Index');
    }

    public function delete ( $id )
    {
        $this->Bank->delete( $id );
        $this->redirect( array( 'action' => 'index' ) );
    }

}
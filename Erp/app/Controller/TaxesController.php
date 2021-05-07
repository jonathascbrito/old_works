<?php
App::uses('AppController', 'Controller');

class TaxesController extends AppController
{

    public $name = 'Taxes';
	public $uses = array
    (
        'Tax'
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
        $this->set( 'controller_name', 'Impostos' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            $this->request->data['Tax']['value'] =
                str_replace
                (
                    array(".", ","), array("", "."),
                    $this->request->data['Tax']['value']
                );

            parent::save
            (
                "Tax",
                "Novo imposto salvo com sucesso!",
                "Houve um problema ao salvar o imposto!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Impostos' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            $this->request->data['Tax']['value'] =
                str_replace
                (
                    array(".", ","), array("", "."),
                    $this->request->data['Tax']['value']
                );

            parent::save
            (
                "Tax",
                "Imposto salvo com sucesso!",
                "Houve um problema ao salvar o imposto!"
            );
        }else{
            $this->Tax->id = $id;
            $this->request->data = $this->Tax->read();
        }

        $this->request->data['Tax']['value'] = (float) $this->request->data['Tax']['value'];
        $this->request->data['Tax']['value'] = number_format( $this->request->data['Tax']['value'], 2, ',', '.');

        $this->set( 'id', $id );
        $this->render( 'form' );
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Impostos' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Tax.name LIKE" => "%{$terms}%",
                    "Tax.value LIKE" => "%{$terms}%",
                    "Tax.base LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set( 'terms', isset( $terms ) ? $terms : false );
        $this->set( 'taxes', $this->paginate('Tax') );
        $this->render('Index');
    }

    public function delete ( $id )
    {
        $this->Tax->delete( $id );
        $this->redirect( array( 'action' => 'index' ) );
    }

}

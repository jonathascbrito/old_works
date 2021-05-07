<?php
App::uses('AppController', 'Controller');

class ResultsCentersController extends AppController
{

    public $name = 'ResultsCenters';
	public $uses = array
    (
        'ResultsCenter'
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
        $this->set( 'controller_name', 'Centros de Resultados' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "ResultsCenter",
                "Novo centro de resultados salvo com sucesso!",
                "Houve um problema ao salvar o centro de resultados!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Centros de Resultados' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "ResultsCenter",
                "Centro de resultados salvo com sucesso!",
                "Houve um problema ao salvar o centro de resultados!"
            );
        }else{
            $this->ResultsCenter->id = $id;
            $this->request->data = $this->ResultsCenter->read();
        }

        $this->set( 'id', $id );
        $this->render( 'form' );
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Centros de Resultados' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "ResultsCenter.code LIKE" => "%{$terms}%",
                    "ResultsCenter.name LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('resultsCenters', $this->paginate('ResultsCenter'));
        $this->render('Index');
    }

    public function delete ( $id )
    {
        $this->ResultsCenter->delete( $id );
        $this->redirect( array( 'action' => 'index' ) );
    }

}
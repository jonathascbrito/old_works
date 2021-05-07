<?php
App::uses('AppController', 'Controller');

class ProblemsController extends AppController
{

    public $name = 'Problems';
    public $uses = array
    (
        'Problem'
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
        $this->set( 'controller_name', 'Tipos de Defeitos' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Problem",
                "Novo tipo de defeito inserido com sucesso!",
                "Houve um problema em editar informações sobre o defeito!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Tipos de Defeitos' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Problem",
                "Defeito editado com sucesso!",
                "Houve um problema em editar o tipo de defeito!"
            );
        }else{
            $this->Problem->id = $id;
            $this->request->data = $this->Problem->read();
        }

        $this->set( 'id', $id );
        $this->render('Form');
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Tipos de Defeitos' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Problem.problem LIKE" => "%{$terms}%",
                    "Problem.description LIKE" => "%{$terms}%",
                    "Problem.prevision LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('problems', $this->paginate('Problem'));
        $this->render('Index');
    }


    public function delete ( $id )
    {
        $this->Problem->delete( $id );
        $this->Session->setFlash('A informação sobre o problema foi deletado com sucesso.', 'message-error');
        $this->redirect( array( 'action' => 'index' ) );
    }

}
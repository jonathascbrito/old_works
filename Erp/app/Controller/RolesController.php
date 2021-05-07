<?php
App::uses('AppController', 'Controller');

class RolesController extends AppController
{

    public $name = 'Roles';
	public $uses = array
    (
        'Role'
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
        $this->set( 'controller_name', 'Perfis' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Role",
                "Novo perfil salvo com sucesso!",
                "Houve um problema ao salvar o perfil!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Perfis' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Role",
                "Perfil salvo com sucesso!",
                "Houve um problema ao salvar o perfil!"
            );
        }else{
            $this->Role->id = $id;
            $this->request->data = $this->Role->read();
        }

        $this->set( 'id', $id );
        $this->render( 'form' );
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Perfis' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Role.name LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('roles', $this->paginate('Role'));
        $this->render('Index');
    }

    public function delete ( $id )
    {
        $this->Role->delete( $id );
        $this->redirect( array( 'action' => 'index' ) );
    }

}

<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController
{

    public $name = 'Users';
	public $uses = array
    (
        'User',
        'Role',
        'Entity'
    );

    public $paginate = array
    (
        'limit' => 25,
        'order' => array
        (
            'username' => 'asc'
        )
    );

    public function __construct($request = null, $response = null) {
        parent::__construct( $request, $response );
        parent::auth( );
    }

    public function setResources ( )
    {
        $this->set( 'roles', $this->Role->find
            (
                "list",
                array
                (
                    "recursive"     => 1,
                    "fields"        => array('Role.id', 'Role.name'),
                    "order"         => array('Role.name asc')
                )
            )
        );

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
    }

    public function add ( )
    {
        $this->set( 'controller_name', 'Usuários' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            $this->request->data['User']['password'] =
                md5($this->request->data['User']['password']);

            parent::save
            (
                "User",
                "Novo usuário salvo com sucesso!",
                "Houve um problema ao salvar o usuário!"
            );
        }

        $this->setResources( );
        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Usuários' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){

            if ( $this->request->data['User']['password'] == null )
            {
                $this->User->id = $id;
                $user = $this->User->read();
                $this->request->data['User']['password'] = $user['User']['password'];
            }else{
                $this->request->data['User']['password'] = md5( $this->request->data['User']['password'] );
            }

            parent::save
            (
                "User",
                "Usuário salvo com sucesso!",
                "Houve um problema ao salvar o usuário!"
            );
        }else{
            $this->User->id = $id;
            $this->request->data = $this->User->read();
        }

        $this->request->data['User']['password'] = null;

        $this->setResources( );
        $this->set( 'id', $id );
        $this->render( 'form' );
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Usuários' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "User.username LIKE" => "%{$terms}%",
                    "User.password LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('users', $this->paginate('User'));
        $this->render('Index');
    }

    public function delete ( $id )
    {
        $this->User->delete( $id );
        $this->redirect( array( 'action' => 'index' ) );
    }

}

<?php
App::uses('AppController', 'Controller');

class ComputersController extends AppController
{

    public $name = 'Computers';
    public $uses = array
    (
        'OrganizationalUnit',
        'Computer',
        'Entity'
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
        $this->set( 'controller_name', 'Cadastro de Computadores' );
        $this->set( 'controller_action', 'Adicionar' );


        $this->set('entities', $this->Entity->find
                        (
                        "list", array
                    (
                    "conditions" => array('employee' => '1'),
                    "order" => array('Entity.name asc')
                        )
                )
        );

        $this->set('departments', $this->OrganizationalUnit->find
                (
                        "list", array
                    (
                    "recursive" => 1,
                    "fields" => array('OrganizationalUnit.id', 'OrganizationalUnit.qualified_name'),
                    "order" => array('OrganizationalUnit.code asc')
                        )
                )
        );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Computer",
                "Novo computador foi cadastrado com sucesso!",
                "Houve um problema ao cadastrar o computador!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Cadastro de Computadores' );
        $this->set( 'controller_action', 'Editar' );


        $this->set('entities', $this->Entity->find
                        (
                        "list", array
                    (
                    "conditions" => array('employee' => '1'),
                    "order" => array('Entity.name asc')
                        )
                )
        );


        $this->set('departments', $this->OrganizationalUnit->find
                (
                        "list", array
                    (
                    "recursive" => 1,
                    "fields" => array('OrganizationalUnit.id', 'OrganizationalUnit.qualified_name'),
                    "order" => array('OrganizationalUnit.code asc')
                        )
                )
        );



        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Computer",
                "Registro do computador editado com sucesso!",
                "Houve um problema ao editar o registro do computador!"
            );
        }else{
            $this->Computer->id = $id;
            $this->request->data = $this->Computer->read();
        }

        $this->set( 'id', $id );
        $this->render('Form');
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Cadastro de Computadores' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Computer.code LIKE" => "%{$terms}%",
                    "Computer.name LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('computers', $this->paginate('Computer'));
        $this->render('Index');
    }


        public function delete ( $id )
    {
        $this->Computer->delete( $id );
        $this->Session->setFlash('O registro do computador foi deletado com sucesso.', 'message-error');
        $this->redirect( array( 'action' => 'index' ) );
    }


}

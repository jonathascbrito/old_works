<?php
App::uses('AppController', 'Controller');

class DevicesController extends AppController
{

    public $name = 'Devices';
    public $uses = array
    (
        'OrganizationalUnit',
        'Device'
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
        $this->set( 'controller_name', 'Cadastro de Equipamentos' );
        $this->set( 'controller_action', 'Adicionar' );


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
                "Device",
                "Novo equipamento foi cadastrado com sucesso!",
                "Houve um problema ao cadastrar o equipamento!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Cadastro de Equipamento' );
        $this->set( 'controller_action', 'Editar' );


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
                "Device",
                "Registro do equipamento editado com sucesso!",
                "Houve um problema ao editar o registro do equipamento!"
            );
        }else{
            $this->Device->id = $id;
            $this->request->data = $this->Device->read();
        }

        $this->set( 'id', $id );
        $this->render('Form');
    }


    public function index ( )
    {
        $this->set( 'controller_name', 'Cadastro de Equipamento' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Device.code LIKE" => "%{$terms}%",
                    "Device.name LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('devices', $this->paginate('Device'));
        $this->render('Index');
    }


        public function delete ( $id )
    {
        $this->Equipment->delete( $id );
        $this->Session->setFlash('O registro do equipamento foi deletado com sucesso.', 'message-error');
        $this->redirect( array( 'action' => 'index' ) );
    }


}

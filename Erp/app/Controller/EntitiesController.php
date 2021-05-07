<?php
App::uses('AppController', 'Controller');

class EntitiesController extends AppController
{

    public $name = 'Entities';
	public $uses = array
    (
        'Entity',
        'OrganizationalUnit'
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

    public function setResources ( )
    {
        $this->set( 'entities', $this->Entity->find
            (
                "list",
                array
                (
                    "recursive"     => 1,
                    "fields"        => array('Entity.id', 'Entity.name', 'Entity.type'),
                    "conditions"    => array
                    (
                        "Entity.type = 'Pessoa Jurídica'"
                    ),
                    "order"         => array('Entity.name asc')
                )
            )
        );

        $this->set( 'organizationalUnits', $this->OrganizationalUnit->find
            (
                "list",
                array
                (
                    "recursive"     => 1,
                    "fields"        => array('OrganizationalUnit.id', 'OrganizationalUnit.qualified_name'),
                    "order"         => array('OrganizationalUnit.code asc')
                )
            )
        );
    }

    public function add ( )
    {
        $this->set( 'controller_name', 'Entidades' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Entity",
                "Nova entidade salva com sucesso!",
                "Houve um problema ao salvar a entidade!"
            );
        }

        $this->setResources( );
        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Entidades' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "Entity",
                "Entidade salva com sucesso!",
                "Houve um problema ao salvar a entidade!"
            );
        }else{
            $this->Entity->id = $id;
            $this->request->data = $this->Entity->read();
        }

        $this->setResources( );
        $this->set( 'id', $id );
        $this->render( 'form' );
    }

    public function view ( $id )
    {
        $this->set( 'controller_name', 'Entidades' );
        $this->set( 'controller_action', 'Detalhes' );

        $this->Entity->id = $id;
        $this->set('entity', $this->Entity->read());

        $this->render('Details');
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Entidades' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Entity.name LIKE" => "%{$terms}%",
                    "Entity.type LIKE" => "%{$terms}%",
                    "Entity.number LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('entities', $this->paginate('Entity'));
        $this->render('Index');
    }

}
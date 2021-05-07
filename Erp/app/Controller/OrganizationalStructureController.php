<?php
App::uses('AppController', 'Controller');

class OrganizationalStructureController extends AppController
{

    public $name = 'OrganizationalStructure';
	public $uses = array
    (
        'OrganizationalUnit'
    );

    public function __construct($request = null, $response = null) {
        parent::__construct( $request, $response );
        parent::auth( );
    }

    public function add ( $level )
    {
        $this->set( 'controller_name', 'Estrutura Organizacional' );
        $this->set( 'controller_action', 'Adicionar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            $count = $this->OrganizationalUnit->find
            (
                'count',
                array
                (
                    'conditions' => array
                    (
                        "OrganizationalUnit.code LIKE '" . $level . "%'"
                    )
                )
            );
            $this->request->data['OrganizationalUnit']['code'] = "{$level}.{$count}";

            parent::save
            (
                "OrganizationalUnit",
                "Novo item salvo com sucesso!",
                "Houve um problema ao salvar o novo item!"
            );
        }

        $this->render( 'form' );
    }

    public function edit ( $id )
    {
        $this->set( 'controller_name', 'Estrutura Organizacional' );
        $this->set( 'controller_action', 'Editar' );

        if ( $this->request->is('post') or $this->request->is('put') ){
            parent::save
            (
                "OrganizationalUnit",
                "Item salvo com sucesso!",
                "Houve um problema ao salvar o item!"
            );
        }else{
            $this->OrganizationalUnit->id = $id;
            $this->request->data = $this->OrganizationalUnit->read();
        }

        $this->set( 'id', $id );
        $this->render( 'form' );
    }

    public function remove ( $id )
    {
        $id = (int) $id;

        $this->OrganizationalUnit->id = $id;
        $ou = $this->OrganizationalUnit->read();

        $count = $this->OrganizationalUnit->find
        (
            'count',
            array
            (
                'conditions' => array
                (
                    "OrganizationalUnit.code LIKE '" . $ou['OrganizationalUnit']['code'] . ".%'"
                )
            )
        );

        if ( $count ) {
            $this->Session->setFlash( "Para remover o item {$ou['OrganizationalUnit']['name']} você deve primeiro remover os itens abaixo dele!", "message-error" );
        }else{
            $this->OrganizationalUnit->delete( $id );
        }

        $this->redirect( array( 'action' => 'index' ) );
    }

    public function index ( )
    {
        $this->set( 'controller_name', 'Estrutura Organizacional' );
        $this->set( 'controller_action', 'Listar' );

        $this->set('organizationalUnits', $this->OrganizationalUnit->find
            (
                'all',
                array
                (
                    'order' => array
                    (
                        'code' => 'asc'
                    )
                )
            )
        );

        $this->render('Index');
    }

}
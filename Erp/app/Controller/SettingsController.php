<?php
App::uses('AppController', 'Controller');

class SettingsController extends AppController
{
    public $name = 'Settings';
    public $uses = array
    (
        'Role',
        'Permission'
    );

    public function __construct($request = null, $response = null) {
        parent::__construct( $request, $response );
        parent::auth( );
    }

    public function permissions ( )
    {
        $this->set( 'controller_name', 'Configurações' );
        $this->set( 'controller_action', 'Permissões' );

        $this->set( 'roles', $this->Role->find( 'all',
            array
            (
                'order' => array( 'Role.name asc' )
            )
        ));

        $this->set( 'permissions', $this->Permission->find( 'all',
            array
            (
                'order' => array( 'Permission.id' )
            )
        ));

        $this->render( 'Permissions' );
    }

}

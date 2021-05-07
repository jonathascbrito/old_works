<?php
App::uses('AppController', 'Controller');

class LoginController extends AppController
{
    public $name = 'Login';
    public $uses = array
    (
        'User'
    );

    public function index ( )
    {
        if ( $this->request->is('post') or $this->request->is('put') ){

            $user = $this->User->find
            (
                'all',
                array
                (
                    "recursive"     => 1,
                    "conditions" => array
                    (
                        "username" => $this->request->data['login']['username'],
                        "password" => md5( $this->request->data['login']['password'] )
                    )
                )
            );

            if ( count($user) == 1 )
            {
                $this->Session->write( 'User', $user[0] );
                $this->redirect( array('controller' => 'organizationalstructure') );
            }

        }

        $this->layout = false;
        $this->render( 'Index' );
    }

}

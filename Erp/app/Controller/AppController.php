<?php

App::uses('Controller', 'Controller');
App::uses('CakeSession', 'Model/Datasource');

class AppController extends Controller
{
    public function auth ( )
    {
        if ( ! CakeSession::check('User') ) :
            $this->redirect( array( "controller" => 'login' ) );
        endif;
    }

    public function save ( $entity, $messageSuccess, $messageError )
    {
        if ( $this->request->is( 'post' ) or $this->request->is( 'put' ) )
        {
            $save_options = array
            (
                "deep"      => true,
                "atomic"    => true
            );

            if ( $this->{$entity}->saveAll( $this->request->data, $save_options ) )
            {
                $this->Session->setFlash( $messageSuccess, "message-success" );
                $this->redirect( array( 'action' => 'index' ) );
            }else{
                $this->Session->setFlash( $messageError, "message-error" );
            }
        }
    }

}

?>

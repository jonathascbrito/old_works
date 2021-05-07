<?php
App::uses('AppController', 'Controller');

class LogoutController extends AppController
{
    public $name = 'Logout';

    public function index ( )
    {
        $this->Session->destroy();
        $this->redirect( array('controller' => 'login') );
    }

}

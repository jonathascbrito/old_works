<?php

App::uses('AppModel', 'Model');

class Role extends AppModel
{
    public $name = 'Role';

    public $validate = array(
        'name' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nome para o perfil!'
        )
    );

}

?>

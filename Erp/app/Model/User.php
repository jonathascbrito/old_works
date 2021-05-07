<?php

App::uses('AppModel', 'Model');

class User extends AppModel
{
    public $name = 'User';

    public $belongsTo = array(
        'Entity' => array
        (
            'className'  => 'Entity',
            'foreignKey' => 'entity_id'
        ),
        'Role' => array
        (
            'className'  => 'Role',
            'foreignKey' => 'role_id'
        )
    );

    public $validate = array(
        'username' => array(
            array(
                'rule'       => 'notEmpty',
                'required'   => true,
                'message'    => 'Informe um nome de usuário!'
            ),
            array
            (
                'rule'       => 'isUnique',
                'required'   => true,
                'message'    => 'O usuário informado já existe!'
            )
        ),
        'password' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe uma senha!'
        ),
        'role_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione o perfil do usuário!'
        )
    );

}

?>

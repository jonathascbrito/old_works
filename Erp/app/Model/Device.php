<?php

App::uses('AppModel', 'Model');

class Device extends AppModel
{
    public $name = 'Device';

    public $belongsTo = array
    (
        'OrganizationalUnit' => array
        (
            'className'  => 'OrganizationalUnit',
            'order'      => 'OrganizationalUnit.name ASC'
        )
    );

    public $validate = array(
        'organizational_unit_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione um departamento pelo qual o computador está lotado!'
        ),
        'code' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'model' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'purchase_date' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'observation' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'name' => array(
            'rule'       => 'notEmpty',
            'message'    => 'Informe se existir o nome do computador!'
        )
    );

}

?>

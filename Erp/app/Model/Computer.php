<?php

App::uses('AppModel', 'Model');

class Computer extends AppModel
{
    public $name = 'Computer';

    public $belongsTo = array
    (
        'Entity' => array
        (
            'className'  => 'Entity',
            'order'      => 'Entity.name ASC'
        ),
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
        'entity_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione um colaborador que utilize o computador!'
        ),
        'code' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'display' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'memory' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'operational_system' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'office' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'cpu' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o registro do computador!'
        ),
        'hard_disc' => array(
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
        'nome' => array(
            'rule'       => 'notEmpty',
            'message'    => 'Informe se existir o nome do computador!'
        )
    );

}

?>

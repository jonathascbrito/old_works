<?php

App::uses('AppModel', 'Model');

class Entity extends AppModel
{
    public $name = 'Entity';

    public $belongsTo = array
    (
        'VinculoEconomico' => array
        (
            'className'  => 'Entity',
            'foreignKey' => 'entity_id',
            'order'      => 'Entity.name ASC'
        )
    );

    public $validate = array(
        'type' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione a natureza da entidade!'
        ),
        'name' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o nome/razão social da entidade!'
        ),
        'number' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o CPF/CNPJ da entidade!'
        )
    );
}

?>
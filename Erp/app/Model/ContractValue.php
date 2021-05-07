<?php

App::uses('AppModel', 'Model');

class ContractValue extends AppModel
{
    public $name = 'ContractValue';

    public $belongsTo = array
    (
        'Contract' => array
        (
            'className'  => 'Contract'
        )
    );

    public $validate = array(
        'base' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o valor do contrato!'
        ),
        'part' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o valor ou porcentagem de êxito!'
        )
    );

}

?>

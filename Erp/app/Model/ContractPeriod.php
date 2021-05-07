<?php

App::uses('AppModel', 'Model');

class ContractPeriod extends AppModel
{
    public $name = 'ContractPeriod';

    public $belongsTo = array
    (
        'Contract' => array
        (
            'className'  => 'Contract'
        )
    );

    public $validate = array(
        'start' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe a data de início do contrato!'
        ),
        'end' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe a data de término do contrato!'
        ),
        'billingdate' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe a data de emissão da nota!'
        ),
        'duedate' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe a data de vencimento!'
        )
    );
}

?>
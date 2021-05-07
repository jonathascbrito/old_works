<?php

App::uses('AppModel', 'Model');

class TransactionPayment extends AppModel
{
    public $name = 'TransactionPayment';

    public $belongsTo = array
    (
        'Transaction' => array
        (
            'className'  => 'Transaction'
        )
    );

    public $validate = array(
        'date' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe a data de baixa'
        ),
        'value' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o valor para baixa'
        )
    );

}

?>

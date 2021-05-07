<?php

App::uses('AppModel', 'Model');

class TransactionResultsCenter extends AppModel
{
    public $name = 'TransactionResultsCenter';

    public $belongsTo = array
    (
        'Transaction' => array
        (
            'className'  => 'Transaction'
        ),
        'ResultsCenter' => array
        (
            'className'  => 'ResultsCenter'
        )
    );

    public $validate = array(
        'part' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe a porcentagem de rateio'
        )
    );

}

?>

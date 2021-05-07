<?php

App::uses('AppModel', 'Model');

class Transaction extends AppModel
{
    public $name = 'Transaction';

    public $belongsTo = array
    (
        'Entity' => array
        (
            'className'  => 'Entity'
        ),
        'BudgetAccount' => array
        (
            'className'  => 'BudgetAccount'
        )
    );

    public $hasMany = array
    (
        'TransactionResultsCenter' => array
        (
            'className'  => 'TransactionResultsCenter'
        ),
        'TransactionPayment' => array
        (
            'className'  => 'TransactionPayment'
        )
    );

    public $validate = array(
        'entity_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe a entidade relacionada ao movimento!'
        ),
        'budget_account_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione a conta orçamentária vinculada ao movimento!'
        )
    );

}

?>

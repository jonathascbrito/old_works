<?php

/**
 * TicketDevice
 *
 * Define o modelo ticketdevice. Este modelo representa os equipamentos do
 * módulo helpdesk.
 */
class Transaction extends AppModel {

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    /**
     * Define os relacionamentos do tipo n-1.
     * @var array
     */
    public $belongsTo = array(
        'Entity' => array(
            'className' => 'Entity',
            'foreignKey' => 'entity_id',
            'dependent' => true
        ),
        'BudgetAccount' => array(
            'className' => 'BudgetAccount',
            'foreignKey' => 'budget_account_id',
            'dependent' => true
        ),
        'DocumentType' => array(
            'className' => 'DocumentType',
            'foreignKey' => 'baixa_document_type_id'
        )
    );

    public $hasAndBelongsToMany = array(
        'ResultsCenters' => array(
            'className' => 'ResultCenter',
            'unique' => 'keepExisting',
            'with' => 'TransactionResultCenter',
            'foreignKey' => 'transaction_id',
            'associationForeignKey' => 'result_center_id'
        )
    );

    public $validate = array(
        'type' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o tipo da movimentação.',
                'required' => true
            )
        ),

        'entity_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a entidade vinculada a movimentação.',
                'required' => true
            )
        ),

        'budget_account_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a conta orçamentária da movimentação.',
                'required' => true
            )
        ),

        'value' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o valor da movimentação.',
                'required' => true
            )
        ),

        'bill_date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a data de competência.',
                'required' => true
            )
        ),

        'pay_date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a data de vencimento.',
                'required' => true
            )
        )
    );
}

?>
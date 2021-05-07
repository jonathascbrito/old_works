<?php

/**
 * TicketDevice
 *
 * Define o modelo ticketdevice. Este modelo representa os equipamentos do
 * módulo helpdesk.
 */
class TransactionResultCenter extends AppModel {

    public $useTable = 'transactions_results_centers';

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
        'Transaction' => array(
            'className' => 'Transaction',
            'foreignKey' => 'transaction_id'
        ),
        'ResultCenter' => array(
            'className' => 'ResultCenter',
            'foreignKey' => 'result_center_id'
        )
    );

    public $validate = array(
        'part' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a porcentagem de rateio para este centro de resultado.',
                'required' => true
            )
        )
    );

}
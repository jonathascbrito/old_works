<?php

/**
 * TicketType
 *
 * Define o modelo tickettype. Este modelo representa os tipos de tickets do
 * módulo helpdesk.
 */
class DocumentType extends AppModel {

    
    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    public $hasMany = array(
        'Transactions' => array(
            'className' => 'Transaction',
            'foreignKey' => 'baixa_document_type_id'
        )
    );

}

?>
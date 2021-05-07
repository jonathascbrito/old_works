<?php

/**
 * TicketDevice
 *
 * Define o modelo ticketdevice. Este modelo representa os equipamentos do
 * módulo helpdesk.
 */
class TicketTest extends AppModel {

    public $useTable = 'tickets_tests';

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
        'Ticket' => array(
            'className' => 'Ticket',
            'foreignKey' => 'ticket_id'
        ),
        'Test' => array(
            'className' => 'Test',
            'foreignKey' => 'test_id'
        )
    );

}
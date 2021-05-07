<?php

App::uses('AppModel', 'Model');

class TicketAnswer extends AppModel
{
    public $name = 'TicketAnswer';

    public $belongsTo = array
    (
        'Ticket' => array
        (
            'className'  => 'Ticket',
            'order'      => 'Ticket.id ASC'
        ),
        'EntitySender' => array
        (
            'foreignKey' => 'sender_id',
            'className' => 'Entity'
        )
    );


    public $validate = array
    (
        'answer' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'O campo mensagem não pode ficar em branco!'
        )
    );


}

?>
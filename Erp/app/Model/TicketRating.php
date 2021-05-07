<?php

App::uses('AppModel', 'Model');

class TicketRating extends AppModel
{
    public $name = 'TicketRating';

    public $belongsTo = array
    (
        'Ticket' => array
        (
            'className'  => 'Ticket',
            'order'      => 'Ticket.id ASC'
        )
    );

    public $validate = array
    (
        'difficulty_resolved' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Informe se a dificuldade foi resolvida'
            ),
        'rating' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Informe uma nota para o atendimento'
            ),
        'observation' => array(
            'rule' => 'notEmpty',
            'required' => false
            )
    );


}



?>
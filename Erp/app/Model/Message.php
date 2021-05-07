<?php

App::uses('AppModel', 'Model');

class Message extends AppModel {

    public $name = 'Message';
    public $hasMany = array
    (
        'MessageContent' => array
        (
            'className' => 'MessageContent',
            'order' => 'MessageContent.id ASC'
        )
    );

    public $belongsTo = array
        (
        'Entity' => array
            (
            'foreignKey' => 'sender_id',
            'className' => 'Entity',
            'order' => 'Entity.name ASC'
        ),
        'EntityReceiving' => array
            (
            'foreignKey' => 'receiver_id',
            'className' => 'Entity',
            'order' => 'Entity.name ASC'
        ),
    );

    public $validate = array(
        'receiver_name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Informe o destinatário da mensagem!'
        ),
        'subject' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Informe o assunto da mensagem!'
        )
    );

}

?>

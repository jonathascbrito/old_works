<?php

App::uses('AppModel', 'Model');

class Ticket extends AppModel
{
    public $name = 'Ticket';

    public $belongsTo = array
    (
        'Entity' => array
        (
            'className'  => 'Entity',
            'order'      => 'Entity.name ASC'
        ),
         'Problem' => array
         (
            'className'  => 'Problem',
            'order'      => 'Problem.problem ASC'
        ),
        'Computer' => array
         (
            'className'  => 'Computer',
            'order'      => 'Computer.name ASC'
        ),
        'Device' => array
         (
            'className'  => 'Device',
            'order'      => 'Device.name ASC'
        )
    );




    public $validate = array(
        'entity_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe quem solicita atendimento!'
        ),
        'priority' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'problem_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o tipo de dificuldade!'
        ),
        'description' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Realize uma descrição detalhada da dificuldade apresentada!'
        ),
        'computer_id' => array(
            'rule'       => 'notEmpty',
            'required'   => false,
            'message'    => 'Informe o registro do computador!'
        ),
        'device_id' => array(
            'rule'       => 'notEmpty',
            'required'   => false,
            'message'    => 'Informe o registro do computador!'
        ),
        'closing_observation' => array(
            'rule'       => 'notEmpty'
        )

    );




}

?>

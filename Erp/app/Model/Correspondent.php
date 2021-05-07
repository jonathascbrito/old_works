<?php

App::uses('AppModel', 'Model');

class Correspondent extends AppModel {

    public $name = 'Correspondent';

     public $belongsTo = array
        (
        'Entity' => array
            (
            'foreignKey' => 'cliente_id',
            'className' => 'Entity',
            'order' => 'Entity.name ASC'
        ),
        'Entity' => array
            (
            'foreignKey' => 'correspondent_id',
            'className' => 'Entity',
            'order' => 'Entity.name ASC'
        ),
    );

     public $validate = array(

        'entity_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe quem solicita atendimento!'
        ),
        'correspondent_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe quem solicita atendimento!'
        ),
        'date_audience' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'adverse_party' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o tipo de dificuldade!'
        ),
        'process_number' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'judicial_district_act' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'judicial_district_origin' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'distance' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'realized_act' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'preposto' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'value_correct' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'status' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'situation' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nível de prioridade!'
        ),
        'observation' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Realize uma descrição detalhada da dificuldade apresentada!'
        )

    );


}

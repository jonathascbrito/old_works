<?php

App::uses('AppModel', 'Model');

class Problem extends AppModel
{
    public $name = 'Problem';

    public $validate = array(
        'problem' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe a dificuldade!'
        ),
        'description' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Faça uma breve descrição do problema!'
        ),
        'prevision' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Define uma previsão para normalizar o problema!'
        )
    );

}

?>

<?php

App::uses('AppModel', 'Model');

class Tax extends AppModel
{
    public $name = 'Tax';

    public $validate = array(
        'name' => array(
            array
            (
                'rule'       => 'notEmpty',
                'required'   => true,
                'message'    => 'Informe um nome para o imposto!'
            ),
            array
            (
                'rule'       => 'isUnique',
                'required'   => true,
                'message'    => 'O imposto especificado já foi cadastrado!'
            )
        ),
        'base' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione a base de cálculo!'
        ),
        'value' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o valor do imposto!'
        )
    );

}

?>

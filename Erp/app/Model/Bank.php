<?php

App::uses('AppModel', 'Model');

class Bank extends AppModel
{
    public $name = 'Bank';

    public $validate = array(
        'name' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe uma descrição para essa conta!'
        ),
        'bank' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o código do banco!'
        ),
        'bank_name' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o nome do banco!'
        ),
        'agency' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o número da agência!'
        ),
        'account' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o número da conta!'
        ),
        'account_digit' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o dígito verificador da conta!'
        ),
        'agency_digit' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o dígito verificador da agência!'
        )
    );

}

?>

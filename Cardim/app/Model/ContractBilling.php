<?php

/**
 * Protocol
 *
 * Define o modelo protocol. Este modelo representa os protocolos cadastrados no
 * sistema.
 */
class ContractBilling extends AppModel {

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
        'Contract' => array(
            'className' => 'Contract',
            'foreignKey' => 'contract_id',
            'dependent' => true
        )
    );

    public $validate = array(
        'value' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o valor da nota.',
                'required' => true
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a descrição dos serviços.',
                'required' => true
            )
        ),
        'state' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o estado vinculado a nota.',
                'required' => true
            )
        ),
        'number' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o número da nota.',
                'required' => true
            )
        ),
        'date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a data de emissão da nota.',
                'required' => true
            )
        )
    );

}
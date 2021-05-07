<?php

/**
 * Protocol
 *
 * Define o modelo protocol. Este modelo representa os protocolos cadastrados no
 * sistema.
 */
class Contract extends AppModel {

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
        'Entity' => array(
            'className' => 'Entity',
            'foreignKey' => 'entity_id',
            'dependent' => true
        )
    );
    
    /**
     * Define os relacionamentos do tipo n-n.
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Attachments' => array(
            'className' => 'Attachment',
            'joinTable' => 'contracts_attachments',
            'unique' => 'keepExisting',
            'order' => 'Attachments.created asc'
        )
    );

    public $validate = array(
        'situation' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe qual a situação da proposta.',
                'required' => true
            )
        ),

        'entity_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o cliente vinculado a proposta.',
                'required' => true
            )
        ),

        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma breve descrição sobre a proposta.',
                'required' => true
            )
        ),

        'date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a data que foi encaminhada a proposta.',
                'required' => true
            )
        )
    );
    
    /**
     * Método executado antes de salvar um modelo. Garante que o número do
     * protocolo seja gerado corretamente.
     *
     * @param array $options
     * @return boolean
     *
    public function beforeSave($options = array()) {
        $this->data['Contract']['code_year'] = date('Y');

        $last = $this->field('code_number', array('Contract.code_year' => date('Y')), 'Contract.created desc');
        $last = $last ? $last : 0;
        $last = (int) $last + 1;

        $this->data['Contract']['code_number'] = str_pad($last, 15, '0', STR_PAD_LEFT);

        return parent::beforeSave($options);
    }
    */
}
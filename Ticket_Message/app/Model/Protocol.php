<?php

/**
 * Protocol
 *
 * Define o modelo protocol. Este modelo representa os protocolos cadastrados no
 * sistema.
 */
class Protocol extends AppModel {

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
        'To' => array(
            'className' => 'User',
            'foreignKey' => 'to'
        ),
        'From' => array(
            'className' => 'User',
            'foreignKey' => 'from'
        ),
        'Logistic' => array(
            'className' => 'User',
            'foreignKey' => 'logistic'
        )
    );

    /**
     * Define os relacionamentos do tipo n-n.
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Attachments' => array(
            'className' => 'Attachment',
            'joinTable' => 'protocols_attachments',
            'unique' => 'keepExisting',
            'order' => 'Attachments.created asc'
        )
    );

    /**
     * Define as regras de validação do modelo.
     * @var array
     */
    public $validate = array(
        'type' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o tipo de protocolo.',
                'required' => true
            )
        ),
        'priority' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a prioridade do documento.',
                'required' => true
            )
        ),
        'to' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o usuário de destino.',
                'required' => false
            )
        ),
        'from' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o usuário remetente.',
                'required' => false
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma breve descrição sobre o documento.',
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
     */
    public function beforeSave($options = array()) {
        $this->data['Protocol']['code_year'] = date('Y');

        $last = $this->field('code_number', array('Protocol.code_year' => date('Y')), 'Protocol.created desc');
        $last = $last ? $last : 0;
        $last = (int) $last + 1;

        $this->data['Protocol']['code_number'] = str_pad($last, 15, '0', STR_PAD_LEFT);

        return parent::beforeSave($options);
    }

}

?>
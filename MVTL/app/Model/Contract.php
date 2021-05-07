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
        ),
        'ResultCenter' => array(
            'className' => 'ResultCenter',
            'foreignKey' => 'result_center_id',
            'dependent' => true
        ),
        'BudgetAccount' => array(
            'className' => 'BudgetAccount',
            'foreignKey' => 'budget_account_id',
            'dependent' => true
        )
    );

    /**
     * Define os relacionamentos do tipo n-1.
     * @var array
     */
    public $hasMany = array(
        'Billings' => array(
            'className' => 'ContractBilling',
            'foreignKey' => 'contract_id',
            'dependent' => true
        )
    );

    public $validate = array(
        'type' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o tipo do contrato.',
                'required' => true
            )
        ),

        'entity_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a entidade vinculada ao contrato.',
                'required' => true
            )
        ),

        'result_center_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o centro de resultados do contrato.',
                'required' => true
            )
        ),

        'budget_account_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a conta orçamentária do contrato.',
                'required' => true
            )
        ),

        'object' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma breve descrição sobre o objeto do contrato.',
                'required' => true
            )
        ),

        'value' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o valor do contrato.',
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
        $this->data['Contract']['code_year'] = date('Y');

        $last = $this->field('code_number', array('Contract.code_year' => date('Y')), 'Contract.created desc');
        $last = $last ? $last : 0;
        $last = (int) $last + 1;

        $this->data['Contract']['code_number'] = str_pad($last, 15, '0', STR_PAD_LEFT);

        return parent::beforeSave($options);
    }

}
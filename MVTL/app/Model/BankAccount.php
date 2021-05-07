<?php

/**
 * BankAccount
 *
 * Define o modelo bankaccount. Este modelo representa as contas bancárias
 * cadastradas no sistema.
 */
class BankAccount extends AppModel {

    /**
     * Define a tabela utilizada para guardar os dados do modelo.
     * @var string
     */
    public $useTable = 'banks_accounts';

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    /**
     * Define as regras de validação do modelo.
     * @var array
     */
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe um nome para identificar a conta.',
                'required' => true
            )
        ),
        'bank' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o banco onde a conta está registrada.',
                'required' => true
            )
        ),
        'agency' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o número da agência.',
                'required' => true
            )
        ),
        'account' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o número da conta.',
                'required' => true
            )
        )
    );

    /**
     * Construtor do modelo. Configura o campo virtual "qualified_name",
     * responsável por exibir uma versão completa do código e nome de uma conta
     * orçamentária.
     *
     * @param mixed $id
     * @param string $table
     * @param mixed $ds
     */
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->virtualFields['qualified_name'] = sprintf
        (
            'CONCAT(%s.bank, " - ", %s.agency, " ", %s.account, " (", %s.name, ")")',
            $this->alias,
            $this->alias,
            $this->alias,
            $this->alias
        );
    }

}

?>
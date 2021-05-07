<?php

/**
 * BudgetAccount
 *
 * Define o modelo budgetaccount. Este modelo representa as contas orçamentárias
 * do sistema.
 */
class BudgetAccount extends AppModel {

    /**
     * Define a tabela utilizada para guardar os dados do modelo.
     * @var string
     */
    public $useTable = 'budgets_accounts';

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
        'code' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o código da conta orçamentária.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O código informado já está sendo utilizado.',
                'required' => true
            )
        ),
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe um nome para a conta orçamentária.',
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
            'CONCAT(%s.code, " - ", %s.name)',
            $this->alias,
            $this->alias
        );
    }

}

?>
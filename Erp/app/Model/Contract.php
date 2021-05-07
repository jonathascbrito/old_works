<?php

App::uses('AppModel', 'Model');

class Contract extends AppModel
{
    public $name = 'Contract';

    public $belongsTo = array
    (
        'Entity' => array
        (
            'className'  => 'Entity',
            'order'      => 'Entity.name ASC'
        ),

        'ResultsCenter' => array
        (
            'className'  => 'ResultsCenter',
            'order'      => 'ResultsCenter.code ASC'
        ),

        'BudgetAccount' => array
        (
            'className'  => 'BudgetAccount',
            'order'      => 'BudgetAccount.code ASC'
        )
    );

    public $hasMany = array
    (
        'ContractPeriod' => array
        (
            'className'  => 'ContractPeriod',
            'order'      => 'ContractPeriod.created DESC',
            'limit'      => 1
        ),

        'ContractValue' => array
        (
            'className'  => 'ContractValue',
            'order'      => 'ContractValue.created DESC',
            'limit'      => 1
        )
    );

    public $validate = array(
        'entity_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione uma entidade!'
        ),
        'type' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione o tipo do contrato!'
        ),
        'object' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe o objeto do contrato!'
        ),
        'budget_account_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione a conta orçamentária vinculada ao contrato!'
        ),
        'results_center_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione o centro de resultados vinculado ao contrato!'
        )
    );

    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);

        $this->virtualFields['qualified_name'] = sprintf
        (
            'CONCAT(%s.id, " - ", Entity.name)',
            $this->alias
        );
    }
}

?>

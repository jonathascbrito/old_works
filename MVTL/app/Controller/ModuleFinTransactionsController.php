<?php

/**
 * ModuleUsersController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os usuários
 * da aplicação.
 */
class ModuleFinTransactionsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'User',
        'Entity',
        'ResultCenter',
        'BudgetAccount',
        'BankAccount',
        'DocumentType',
        'Transaction',
        'TransactionResultCenter',
        'Setting'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Transaction.id' => 'desc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Transactions';
    public $bundle = 'ModulesFin';

    protected function all() {
        $this->paginate['conditions']['and'][] = 'Transaction.type in (0, 1)';
    }

    protected function movimentacoes_diarias() {
        $this->paginate['conditions']['and'][] = 'Transaction.type in (0, 1)';
        $this->paginate['conditions']['and'][] = 'IFNULL(Transaction.baixa_value, 0) < Transaction.value';
        $this->paginate['conditions']['and'][] = 'DATEDIFF(CURDATE(), str_to_date(Transaction.pay_date, \'%d/%m/%Y\')) = 0';
    }

    protected function provisionadas() {
        $this->paginate['conditions']['and'][] = 'Transaction.type in (0, 1)';
        $this->paginate['conditions']['and'][] = 'IFNULL(Transaction.baixa_value, 0) < Transaction.value';
        $this->paginate['conditions']['and'][] = 'DATEDIFF(CURDATE(), str_to_date(Transaction.pay_date, \'%d/%m/%Y\')) <= 0';
    }

    protected function aprovadas() {
        $this->paginate['conditions']['and'][] = 'Transaction.type in (0, 1)';
        $this->paginate['conditions']['and'][] = 'IFNULL(Transaction.baixa_value, 0) = Transaction.value';
    }

    protected function vencidas() {
        $this->paginate['conditions']['and'][] = 'Transaction.type in (0, 1)';
        $this->paginate['conditions']['and'][] = 'IFNULL(Transaction.baixa_value, 0) < Transaction.value';
        $this->paginate['conditions']['and'][] = 'DATEDIFF(CURDATE(), str_to_date(Transaction.pay_date, \'%d/%m/%Y\')) > 0';
    }

    /**
     * Lista os usuários do sistema.
     * @controller-action
     */
    public function index($filter = 'index') {
        $this->Transaction->recursive = 1;

        if ( ! in_array($filter, array('all', 'movimentacoes_diarias', 'provisionadas', 'aprovadas', 'vencidas'))) {
            throw new NotFoundException();
        }

        $this->setSearch('Transaction', array(
            'entidade'    => 'Entity.name',
            'tipo'   => 'Transaction.type',
            'value'   => 'Transaction.value',
            'vencimento'   => 'Transaction.pay_date',
            'competência'   => 'Transaction.bill_date',
            'conta orçamentária'   => 'BudgetAccount.name'
        ));

        $this->{$filter}();

        $this->set('title', 'Módulos > Financeiro');
        $this->set('transactions', $this->paginate('Transaction'));

//        var_dump($this->Transaction->query('select Transaction.baixa_value, IFNULL(Transaction.baixa_value, 0) < Transaction.value from transactions as Transaction'));
    }

    /**
     * Método responsável por criar um novo usuário. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);
        $this->set('baixa', $this->hasPermission('ModuleFinTransactions close'));

        if ($this->isMethod('post')) {
            $transaction = $this->Transaction->saveAll($this->request->data);

            if ($transaction) {
                $this->set('success', true);
            }

            if (isset($this->Transaction->validationErrors['entity_id'])) {
                $this->Transaction->validationErrors['entity_id_name'] = $this->Transaction->validationErrors['entity_id'];
            }

            if (isset($this->Transaction->validationErrors['budget_account_id'])) {
                $this->Transaction->validationErrors['budget_account_id_name'] = $this->Transaction->validationErrors['budget_account_id'];
            }

            if (isset($this->Transaction->validationErrors['baixa_document_type_id'])) {
                $this->Transaction->validationErrors['baixa_document_type_id_name'] = $this->Transaction->validationErrors['baixa_document_type_id'];
            }
        }
    }

    /**
     * Método responsável por editar um usuário já cadastrado. Exibe o formulário
     * preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);
        $this->set('baixa', $this->hasPermission('ModuleFinTransactions close'));

        $this->Transaction->recursive = 1;

        if ($this->isMethod('get')) {
            $this->Transaction->id = $id;
            $this->Transaction->recursive = 1;

            $transaction = $this->Transaction->read(null, $id);

            if ( ! $transaction) {
                throw new NotFoundException();
            }

            $this->request->data = $transaction;

            $this->request->data['Transaction']['entity_id_name'] = $this->request->data['Entity']['name'];
            $this->request->data['Transaction']['budget_account_id_name'] = $this->request->data['BudgetAccount']['qualified_name'];
            $this->request->data['Transaction']['baixa_document_type_id_name'] = $this->request->data['DocumentType']['name'];

            $i = 0;
            $this->request->data['Transaction']['ResultsCenters'] = array();
            foreach ($this->request->data['ResultsCenters'] as $resultcenter) {
                $this->request->data['Transaction']['ResultsCenters'][$i] = array();
                $this->request->data['Transaction']['ResultsCenters'][$i]['result_center_id'] = $resultcenter['id'];
                $this->request->data['Transaction']['ResultsCenters'][$i]['result_center_id_name'] = $resultcenter['qualified_name'];
                $this->request->data['Transaction']['ResultsCenters'][$i]['part'] = $resultcenter['TransactionResultCenter']['part'];

                $i++;
            }
        }

        if ($this->isMethod('put')) {
            if ($this->Transaction->saveAll($this->request->data)) {
                $this->set('success', true);
            }

            if (isset($this->Transaction->validationErrors['entity_id'])) {
                $this->Transaction->validationErrors['entity_id_name'] = $this->Transaction->validationErrors['entity_id'];
            }

            if (isset($this->Transaction->validationErrors['budget_account_id'])) {
                $this->Transaction->validationErrors['budget_account_id_name'] = $this->Transaction->validationErrors['budget_account_id'];
            }
        }

        $this->set('id', $id);
    }

    /**
     * Método responsável por popular as sugestões do campo entities.
     * @controller-action
     */
    public function entities() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->Entity->find('list', array(
            'conditions' => array(
                'Entity.type !=' => 'Gr',
                'Entity.name like' => '%' . $q . '%'
            )
        )));
    }

    /**
     * Método responsável por popular as sugestões do campo entities.
     * @controller-action
     */
    public function resultscenters() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';
        $i = isset($this->request->data['i']) ? $this->request->data['i'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->ResultCenter->find('list', array(
            'fields' => array('ResultCenter.id', 'ResultCenter.qualified_name'),
            'conditions' => array(
                'and' => array(
                    'ResultCenter.code like' => $this->Setting->field('value', array('name' => 'result_center_' . $i)) . '%',
                    'or' => array(
                        'ResultCenter.code like' => $q . '%',
                        'ResultCenter.name like' => '%' . $q . '%'
                    )
                )
            )
        )));
    }

    /**
     * Método responsável por popular as sugestões do campo entities.
     * @controller-action
     */
    public function budgetsaccounts() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';
        $i = isset($this->request->data['i']) ? $this->request->data['i'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->BudgetAccount->find('list', array(
            'fields' => array('BudgetAccount.id', 'BudgetAccount.qualified_name'),
            'conditions' => array(
                'and' => array(
                    'BudgetAccount.code like' => $this->Setting->field('value', array('name' => 'budget_account_' . $i)) . '%',
                    'or' => array(
                        'BudgetAccount.code like' => $q . '%',
                        'BudgetAccount.name like' => '%' . $q . '%'
                    )
            )   )
        )));
    }

    public function documents() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->DocumentType->find('list', array(
            'fields' => array('DocumentType.id', 'DocumentType.name'),
            'conditions' => array(
                'DocumentType.name like' => $q . '%'
            )
        )));
    }

    /**
     * Método responsável por popular as sugestões do campo entities.
     * @controller-action
     */
    public function banksaccounts() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->BankAccount->find('list', array(
            'fields' => array('BankAccount.id', 'BankAccount.qualified_name'),
            'conditions' => array(
                'or' => array(
                    'BankAccount.name like' => '%' . $q . '%',
                    'BankAccount.bank like' => '%' . $q . '%',
                    'BankAccount.agency like' => '%' . $q . '%',
                    'BankAccount.account like' => '%' . $q . '%'
                )
            )
        )));
    }
}

?>
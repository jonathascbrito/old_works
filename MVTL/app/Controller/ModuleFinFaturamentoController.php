<?php

/**
 * ModuleUsersController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os usuários
 * da aplicação.
 */
class ModuleFinFaturamentoController extends AppController
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
        'Contract',
        'ContractBilling'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Contract.id' => 'desc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Faturamento';
    public $bundle = 'ModulesFin';

    /**
     * Lista os usuários do sistema.
     * @controller-action
     */
    public function index() {
        $this->Contract->recursive = 1;

        $this->setSearch('Contract', array(
            'entidade'              => 'Entity.name',
            'valor'                 => 'Contract.value',
            'objeto'                => 'Contract.object',
            'tipo'                  => 'Contract.type',
            'centro de resultados'  => 'ResultCenter.name',
            'conta orçamentária'    => 'BudgetAccount.name'
        ));

        $this->set('title', 'Módulos > Financeiro > Faturamento');
        $this->set('contracts', $this->paginate('Contract'));
    }

    /**
     * Método responsável por criar um novo usuário. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function billings() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            $ids = array();

            if (isset($this->request->data['toggle'])) {
                $ids = array_keys(array_filter($this->request->data['toggle']));
            }

            if (count($ids) !== 1) {
                $this->bundle = 'App';
                $this->path = false;

                return $this->render('handle_update');
            }
        }

        $this->Contract->recursive = 1;
        $contract = $this->Contract->read(null, $ids[0]);

        $this->set('contract', $contract);
    }

    /**
     * Método responsável por criar um novo usuário. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create($contract_id) {
        $this->isAjaxRequest(true);

        $this->Contract->recursive = 1;
        $contract = $this->Contract->read(null, $contract_id);

        $this->set('contract', $contract);

        if ($this->isMethod('post')) {
            if ($this->ContractBilling->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
    }

    public function update($contract_id, $contract_billing_id) {
        $this->isAjaxRequest(true);

        $this->Contract->recursive = 1;

        $contract = $this->Contract->read(null, $contract_id);
        $contract_billing = $this->ContractBilling->read(null, $contract_billing_id);

        $this->set('contract', $contract);
        $this->set('contractBilling', $contract_billing);

        if ($this->isMethod('get')) {
            $this->request->data = $contract_billing;
        }

        if ($this->isMethod('post')) {
            if ($this->ContractBilling->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
    }
}

?>
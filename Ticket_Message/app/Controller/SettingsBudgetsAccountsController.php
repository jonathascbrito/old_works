<?php

/**
 * SettingsBudgetsAccountsController
 *
 * Controlador responsável pela configuração das contas orçamentárias do sistema.
 */
class SettingsBudgetsAccountsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'BudgetAccount'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'BudgetAccount.code' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'BudgetsAccounts';
    public $bundle = 'SettingsSystem';

    /**
     * Lista as contas orçamentárias do sistema.
     * @controller-action
     */
    public function index() {
        $this->setSearch('BudgetAccount', array(
            'código'   => 'BudgetAccount.code',
            'nome'     => 'BudgetAccount.name'
        ));

        $this->set('title', 'Configurações > Contas Orçamentárias');
        $this->set('budgetsaccounts', $this->paginate('BudgetAccount'));
    }

    /**
     * Método responsável por criar uma nova conta orçamentária. Exibe um
     * formulário ou uma mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->BudgetAccount->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
    }

    /**
     * Método responsável por editar uma conta orçamentária já cadastrada. Exibe
     * o formulário preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('get')) {
            $this->BudgetAccount->id = $id;

            $budgetaccount = $this->BudgetAccount->read(null, $id);

            if ( ! $budgetaccount) {
                throw new NotFoundException();
            }

            $this->request->data = $budgetaccount;
        }

        if ($this->isMethod('put')) {
            if ($this->BudgetAccount->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
    }

    /**
     * Método responsável por apagar uma conta orçamentária já cadastrada. Exibe
     * um alerta para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        $budgetaccount = $this->BudgetAccount->read(null, $id);

        if ( ! $budgetaccount) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('budgetaccount', $budgetaccount);

        if ($this->isMethod('delete')) {
            if ($this->BudgetAccount->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
<?php

/**
 * ModuleUsersController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os usuários
 * da aplicação.
 */
class ModuleAdmContractController extends AppController
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
        'Contract'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Contract.code_year' => 'desc',
            'Contract.code_number' => 'desc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Contracts';
    public $bundle = 'ModulesAdm';

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

        $this->set('title', 'Módulos > Administrativo');
        $this->set('contracts', $this->paginate('Contract'));
    }

    /**
     * Método responsável por criar um novo usuário. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            $contract = $this->Contract->saveAll($this->request->data);

            if ($contract) {
                $this->set('success', true);
            }

            if (isset($this->Contract->validationErrors['entity_id'])) {
                $this->Contract->validationErrors['entity_id_name'] = $this->Contract->validationErrors['entity_id'];
            }

            if (isset($this->Contract->validationErrors['result_center_id'])) {
                $this->Contract->validationErrors['result_center_id_name'] = $this->Contract->validationErrors['result_center_id'];
            }

            if (isset($this->Contract->validationErrors['budget_account_id'])) {
                $this->Contract->validationErrors['budget_account_id_name'] = $this->Contract->validationErrors['budget_account_id'];
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

        if ($id == 1) {
            throw new UnauthorizedException();
        }

        if ($this->isMethod('get')) {
            $this->Contract->id = $id;
            $this->Contract->recursive = 1;

            $contract = $this->Contract->read(null, $id);

            if ( ! $contract) {
                throw new NotFoundException();
            }

            $this->request->data = $contract;
            $this->request->data['Contract']['entity_id_name'] = $this->request->data['Entity']['name'];
            $this->request->data['Contract']['result_center_id_name'] = $this->request->data['ResultCenter']['qualified_name'];
            $this->request->data['Contract']['budget_account_id_name'] = $this->request->data['BudgetAccount']['qualified_name'];
        }

        if ($this->isMethod('put')) {
            if ($this->Contract->saveAll($this->request->data)) {
                $this->set('success', true);
            }

            if (isset($this->Contract->validationErrors['entity_id'])) {
                $this->Contract->validationErrors['entity_id_name'] = $this->Contract->validationErrors['entity_id'];
            }

            if (isset($this->Contract->validationErrors['result_center_id'])) {
                $this->Contract->validationErrors['result_center_id_name'] = $this->Contract->validationErrors['result_center_id'];
            }

            if (isset($this->Contract->validationErrors['budget_account_id'])) {
                $this->Contract->validationErrors['budget_account_id_name'] = $this->Contract->validationErrors['budget_account_id'];
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

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->ResultCenter->find('list', array(
            'fields' => array('ResultCenter.id', 'ResultCenter.qualified_name'),
            'conditions' => array(
                'or' => array(
                    'ResultCenter.code like' => $q . '%',
                    'ResultCenter.name like' => '%' . $q . '%'
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

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->BudgetAccount->find('list', array(
            'fields' => array('BudgetAccount.id', 'BudgetAccount.qualified_name'),
            'conditions' => array(
                'or' => array(
                    'BudgetAccount.code like' => $q . '%',
                    'BudgetAccount.name like' => '%' . $q . '%'
                )
            )
        )));
    }
}

?>
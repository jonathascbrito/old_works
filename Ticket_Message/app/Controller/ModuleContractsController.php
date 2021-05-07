<?php

/**
 * ModuleContractsController
 *
 * Controlador responsável pelo sistema de propostas/contratos. Permite gerenciar os
 * documentos recebidos e enviados.
 */
class ModuleContractsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Contract',
        'Entity'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Contract.name' => 'desc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Contracts';
    public $bundle = 'ModulesContracts';


    /**
     * Lista os contratos do sistema.
     * @controller-action
     */
    public function index() {
        $this->Contract->recursive = 1;

        $this->setSearch('Contract', array(
            'situação'       => 'Contract.situation',
            'nome'     => 'Entity.name',
            'data'  => 'Contract.date',
            'descrição'  => 'Contract.description',
            'serviço' => 'Contract.service'
        ));

        $this->set('title', 'Módulos > Propostas');
        $this->set('contracts', $this->paginate('Contract'));
    }

    /**
     * Método responsável por exibir detalhes sobre uma proposta previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Contract->id = $id;
        $this->Contract->recursive = 1;

        $contract = $this->Contract->read(null, $id);

        if ( ! $contract) {
            throw new NotFoundException();
        }

        $this->set('contract', $contract);
    }

    /**
     * Método responsável por criar um novo contratos. Exibe um formulário ou
     * uma mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            
            if ($this->Contract->saveAll($this->request->data)) {
                $this->set('success', true);
            }

        }
    }

    /**
     * Método responsável por popular as sugestões do campo to e logistic.
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
     * Método responsável por editar uma entidade já cadastrada. Exibe o formulário
     * preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        $this->Contract->id = $id;
        $this->Contract->recursive = 1;

        $contract = $this->Contract->read(null, $id);

        if ( ! $contract) {
            throw new NotFoundException();
        }

        $this->set('contract', $contract);

        if ($this->isMethod('get')) {
            $this->Contract->id = $id;
            $this->Contract->recursive = 1;

            //$contract = $this->Contract->read(null, $id);
            //$entity_id = $contract['Contract']['entity_id'];
            //$this->Entity->recursive = 1;
            //$entity = $this->Entity->read(null, $entity_id);

            //$this->set('entity', $entity);
           

            if ( ! $contract) {
                throw new NotFoundException();
            }

            $this->request->data = $contract;
        }

        if ($this->isMethod('put')) {
            if ($this->Contract->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
        
        $this->set('id', $id);

    }

    /**
     * Método responsável por apagar uma entidade já cadastrada. Exibe um alerta
     * para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        $contract = $this->Contract->read(null, $id);

        if ( ! $contract) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('contract', $contract);

        if ($this->isMethod('delete')) {
            if ($this->Contract->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
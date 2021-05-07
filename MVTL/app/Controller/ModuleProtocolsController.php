<?php

/**
 * ModuleProtocolsController
 *
 * Controlador responsável pelo sistema de protocolos. Permite gerenciar os
 * documentos recebidos e enviados.
 */
class ModuleProtocolsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Protocol'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Protocol.code_year' => 'desc',
            'Protocol.code_number' => 'desc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Protocols';
    public $bundle = 'ModulesProtocols';

    /**
     * Configura a listagem de protocolos para exibir qualquer protocolos
     * associado ao usuário autenticado.
     */
    public function all() {
        $this->paginate['conditions']['or']['Protocol.to'] = $this->Auth->user('id');
        $this->paginate['conditions']['or']['Protocol.from'] = $this->Auth->user('id');
    }

    /**
     * Lista os protocolos do sistema.
     * @controller-action
     */
    public function index($type) {
        $this->Protocol->recursive = 1;

        if ( ! in_array($type, array('all'))) {
            throw new NotFoundException();
        }

        $this->setSearch('Protocol', array(
            'ano'        => 'Protocol.code_year',
            'código'     => 'Protocol.code_number',
            'tipo'       => 'Protocol.type',
            'status'     => 'Protocol.status',
            'prioridade' => 'Protocol.priority',
            'de'         => 'From.name',
            'para'       => 'To.name',
            'logistica'  => 'Logistic.name',
            'descrição'  => 'Protocol.description'
        ));

        $this->{$type}();

        $this->set('title', 'Módulos > Protocolos');
        $this->set('protocols', $this->paginate('Protocol'));
    }

    /**
     * Método responsável por exibir detalhes sobre um protocolo previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Protocol->id = $id;
        $this->Protocol->recursive = 1;

        $protocol = $this->Protocol->read(null, $id);

        if ( ! $protocol) {
            throw new NotFoundException();
        }

        $this->set('protocol', $protocol);
    }

    /**
     * Método responsável por criar um novo protocolo. Exibe um formulário ou
     * uma mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->request->data['Protocol']['from'] == $this->Auth->user('id')) {
                $this->request->data['Protocol']['status'] = 'enviado';
            }else{
                $this->request->data['Protocol']['status'] = 'recebido';
            }

            if ($this->Protocol->saveAll($this->request->data)) {
                $this->set('success', true);
            }

            if (isset($this->Protocol->validationErrors['from'])) {
                $this->Protocol->validationErrors['from_name'] = $this->Protocol->validationErrors['from'];
            }

            if (isset($this->Protocol->validationErrors['to'])) {
                $this->Protocol->validationErrors['to_name'] = $this->Protocol->validationErrors['to'];
            }

            if (isset($this->Protocol->validationErrors['logistic'])) {
                $this->Protocol->validationErrors['logistic_name'] = $this->Protocol->validationErrors['logistic'];
            }
        }
    }

    /**
     * Método responsável por popular as sugestões do campo to e logistic.
     * @controller-action
     */
    public function users() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->User->find('list', array(
            'conditions' => array(
                'User.name like' => '%' . $q . '%'
            )
        )));
    }

}

?>
<?php

/**
 * ModuleSystemController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os perfis
 * da aplicação.
 */
class SettingsTestsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Entity',
        'Ticket',
        'Test',
        'Complement'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Test.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Tests';
    public $bundle = 'SettingsSystem';

    /**
     * Lista os perfis do sistema.
     * @controller-action
     */
    public function index() {
        $this->Test->recursive = 1;

        $this->setSearch('Test', array(
            'nome'      => 'Test.name',
            'descrição' => 'Test.description'
        ));

        $this->set('title', 'Configurações > Teste de Equipamentos');
        $this->set('tests', $this->paginate('Test'));
    }

    /**
     * Método responsável por exibir detalhes sobre um perfil previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Test->id = $id;
        $this->Test->recursive = 2;

        $test = $this->Test->read(null, $id);

        if ( ! $test) {
            throw new NotFoundException();
        }

        $this->set('test', $test);
    }

    /**
     * Método responsável por criar um novo perfil. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->Test->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
    }

    /**
     * Método responsável por editar um perfil já cadastrado. Exibe o formulário
     * preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('get')) {
            $this->Test->id = $id;

            $test = $this->Test->read(null, $id);

            if ( ! $test) {
                throw new NotFoundException();
            }

            $this->request->data = $test;
        }

        if ($this->isMethod('put')) {
            if ($this->Test->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
    }

    /**
     * Método responsável por apagar um perfil já cadastrado. Exibe um alerta
     * para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        $test = $this->Test->read(null, $id);

        if ( ! $test) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('test', $test);

        if ($this->isMethod('delete')) {
            if ($this->Test->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
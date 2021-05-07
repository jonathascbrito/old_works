<?php

/**
 * ModuleEntitiesController
 *
 * Controlador responsável pelo sistema de entidades. Permite gerenciar as entidades
 * da aplicação.
 */
class ModuleEntitiesController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Entity',
        'System'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Entity.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Entities';
    public $bundle = 'ModulesEntities';

    /**
     * Lista as entidades do sistema.
     * @controller-action
     */
    public function index() {
        $this->Entity->recursive = 1;

        $this->setSearch('Entity', array(
            'nome'                    => 'Entity.name',
            'email'                   => 'Entity.email',
            'telefone'                => 'Entity.phone',
            'celular'                 => 'Entity.cellphone',
            'endereço'                => 'Entity.address',
            'contact'                 => 'Entity.contact'
        ));

        $this->set('title', 'Módulos > Entidades');
        $this->set('entities', $this->paginate('Entity'));
    }

    /**
     * Método responsável por exibir detalhes sobre uma entidade previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Entity->id = $id;
        $this->Entity->recursive = 1;

        $entity = $this->Entity->read(null, $id);

        if ( ! $entity) {
            throw new NotFoundException();
        }

        $this->set('entity', $entity);
        $this->set('systems', $this->System->find('list'));
    }

    /**
     * Método responsável por criar uma nova entidade. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {


            if ($this->Entity->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
        
        $this->set('systems', $this->System->find('list'));
    }

    /**
     * Método responsável por editar uma entidade já cadastrada. Exibe o formulário
     * preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('get')) {
            $this->Entity->id = $id;
            $this->Entity->recursive = 1;

            $entity = $this->Entity->read(null, $id);

            if ( ! $entity) {
                throw new NotFoundException();
            }

            $this->request->data = $entity;
        }

        if ($this->isMethod('put')) {
            if ($this->Entity->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
        $this->set('systems', $this->System->find('list'));
    }

    /**
     * Método responsável por apagar uma entidade já cadastrada. Exibe um alerta
     * para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        $entity = $this->Entity->read(null, $id);

        if ( ! $entity) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('entity', $entity);

        if ($this->isMethod('delete')) {
            if ($this->Entity->delete($id)) {
                $this->set('success', true);
            }
        }
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
     * Método responsável por popular as sugestões do campo organizational structure.
     * @controller-action
     */
    public function organizational_structure() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->OrganizationalStructure->find('list', array(
            'conditions' => array(
                'OrganizationalStructure.name like' => '%' . $q . '%'
            )
        )));
    }

}

?>
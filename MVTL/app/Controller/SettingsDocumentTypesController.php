<?php

/**
 * SettingsUserController
 *
 * Controlador responsável pela configuração do sistema. Permite gerenciar
 * centros de resultados, contas orçamentárias e parametrizar o sistema.
 */
class SettingsDocumentTypesController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'DocumentType'
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'DocumentTypes';
    public $bundle = 'SettingsSystem';

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'DocumentType.name' => 'asc'
        )
    );

    /**
     * Lista os perfis do sistema.
     * @controller-action
     */
    public function index() {
        $this->DocumentType->recursive = 1;

        $this->setSearch('DocumentType', array(
            'nome'      => 'DocumentType.name'
        ));

        $this->set('title', 'Configurações > Tipos de Documentos');
        $this->set('types', $this->paginate('DocumentType'));
    }

    /**
     * Método responsável por criar um novo perfil. Exibe um formulário ou uma
     * mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->DocumentType->saveAll($this->request->data)) {
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
            $this->DocumentType->id = $id;

            $type = $this->DocumentType->read(null, $id);

            if ( ! $type) {
                throw new NotFoundException();
            }

            $this->request->data = $type;
        }

        if ($this->isMethod('put')) {
            if ($this->DocumentType->saveAll($this->request->data)) {
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

        $type = $this->DocumentType->read(null, $id);

        if ( ! $type) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('type', $type);

        if ($this->isMethod('delete')) {
            if ($this->DocumentType->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
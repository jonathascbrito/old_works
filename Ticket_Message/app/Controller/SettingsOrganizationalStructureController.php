<?php

/**
 * SettingsOrganizationalStructureController
 *
 * Controlador responsável pela configuração da estrutura organizacional da
 * empresa.
 */
class SettingsOrganizationalStructureController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'OrganizationalStructure'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'OrganizationalStructure.code' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'OrganizationalStructure';
    public $bundle = 'SettingsSystem';

    /**
     * Lista a estrutura organizacional da empresa.
     * @controller-action
     */
    public function index() {
        $this->setSearch('OrganizationalStructure', array(
            'código'   => 'OrganizationalStructure.code',
            'nome'     => 'OrganizationalStructure.name'
        ));

        $this->set('title', 'Configurações > Estrutura Organizacional');
        $this->set('organizationalstructure', $this->paginate('OrganizationalStructure'));
    }

    /**
     * Método responsável por criar um novo item na estrutura organizacional.
     * Exibe um formulário ou uma mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->OrganizationalStructure->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
    }

    /**
     * Método responsável por editar um item da estrutura organizacional. Exibe
     * o formulário preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('get')) {
            $this->OrganizationalStructure->id = $id;

            $organizationalstructure = $this->OrganizationalStructure->read(null, $id);

            if ( ! $organizationalstructure) {
                throw new NotFoundException();
            }

            $this->request->data = $organizationalstructure;
        }

        if ($this->isMethod('put')) {
            if ($this->OrganizationalStructure->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
    }

    /**
     * Método responsável por apagar um item da estrutura organizacional. Exibe
     * um alerta para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        $organizationalstructure = $this->OrganizationalStructure->read(null, $id);

        if ( ! $organizationalstructure) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('organizationalstructure', $organizationalstructure);

        if ($this->isMethod('delete')) {
            if ($this->OrganizationalStructure->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
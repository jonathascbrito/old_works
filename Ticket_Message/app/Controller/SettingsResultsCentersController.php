<?php

/**
 * SettingsResultsCentersController
 *
 * Controlador responsável pela configuração dos centros de resultados do
 * sistema.
 */
class SettingsResultsCentersController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'ResultCenter'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'ResultCenter.code' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'ResultsCenters';
    public $bundle = 'SettingsSystem';

    /**
     * Lista os centros de resultados do sistema.
     * @controller-action
     */
    public function index() {
        $this->setSearch('ResultCenter', array(
            'código'   => 'ResultCenter.code',
            'nome'     => 'ResultCenter.name'
        ));

        $this->set('title', 'Configurações > Centros de Resultados');
        $this->set('resultscenters', $this->paginate('ResultCenter'));
    }

    /**
     * Método responsável por criar um novo centro de resultado. Exibe um
     * formulário ou uma mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->ResultCenter->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }
    }

    /**
     * Método responsável por editar um centros de resultados já cadastrada. Exibe
     * o formulário preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('get')) {
            $this->ResultCenter->id = $id;

            $resultcenter = $this->ResultCenter->read(null, $id);

            if ( ! $resultcenter) {
                throw new NotFoundException();
            }

            $this->request->data = $resultcenter;
        }

        if ($this->isMethod('put')) {
            if ($this->ResultCenter->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
    }

    /**
     * Método responsável por apagar um centros de resultados já cadastrada. Exibe
     * um alerta para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        $resultcenter = $this->ResultCenter->read(null, $id);

        if ( ! $resultcenter) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('resultcenter', $resultcenter);

        if ($this->isMethod('delete')) {
            if ($this->ResultCenter->delete($id)) {
                $this->set('success', true);
            }
        }
    }

}

?>
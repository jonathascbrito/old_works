<?php

/**
 * SettingsSystemController
 *
 * Controlador responsável pela configuração do sistema. Permite gerenciar
 * centros de resultados, contas orçamentárias e parametrizar o sistema.
 */
class SettingsSystemController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Setting'
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Settings';
    public $bundle = 'SettingsSystem';

    /**
     * Exibe as configurações e parametrizações do sistema.
     * @controller-action
     */
    public function index() {
        $this->set('title', 'Configurações');
        $this->set('settings', $this->Setting->find('all'));
    }

    /**
     * Salva as alterações nos parâmetros de configuração do sistema.
     * @controller-action
     */
    public function save() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->Setting->saveAll($this->request->data['Settings'])) {
                $this->set('success', true);
            }
        }
    }

}

?>
<?php

/**
 * SettingsUserController
 *
 * Controlador responsável pela configuração do sistema. Permite gerenciar
 * centros de resultados, contas orçamentárias e parametrizar o sistema.
 */
class SettingsUserController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'User'
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Settings';
    public $bundle = 'SettingsUser';

    /**
     * Exibe as configurações e parametrizações do sistema.
     * @controller-action
     */
    public function index() {
        $this->set('title', 'Minha Conta');
    }

    /**
     * Salva as alterações nos parâmetros de configuração do sistema.
     * @controller-action
     */
    public function save() {
        $this->isAjaxRequest(true);

        if($this->request->data['User']['password'] == $this->request->data['User']['confirm']) {
        
            $this->User->id = $this->Auth->user('id');
            $user = $this->User->read();

            $user['User']['password'] = $this->request->data['User']['password'];

            if($this->User->save($user)) {
                $this->set('success', true);
            }
        
        }
    }

}

?>
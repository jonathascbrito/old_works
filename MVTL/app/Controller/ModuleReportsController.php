<?php

/**
 * ModuleUsersController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os usuários
 * da aplicação.
 */
class ModuleReportsController extends AppController
{
    public $bundle = 'ModulesReports';

    public function resultscenters()
    {
        $this->path = 'FinTransactions';

        if($this->isMethod('get')){
            $this->isAjaxRequest(true);

            $this->set('baixas', array('selecione', 'Com registro', 'Sem registro'));
            $this->set('baixaValues', array('selecione', 'Provisionadas', 'Aprovadas', ' Vencidas'));
        }

        if($this->isMethod('post')){
            $this->layout = 'pdf';
            $this->set('title_for_layout', 'Centros de Resultados');
            $this->render('resultscenters-pdf');
        }
    }
}

?>
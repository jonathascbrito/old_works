<?php

App::uses('Permission', 'Model');

/**
 * ModulePermissionsController
 *
 * Controlador responsável pelo sistema de usuários. Permite gerenciar os perfis
 * da aplicação.
 */
class ModulePermissionsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Role',
        'Permission'
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Permissions';
    public $bundle = 'ModulesUsers';

    /**
     * Lista os perfis do sistema.
     * @controller-action
     */
    public function index() {
        $this->Role->recursive = 0;
        $this->Permission->recursive = 1;

        $this->set('roles', $this->Role->find('list'));
        $this->set('permissions', $this->Permission->find('all', array(
            'order' => 'group, name asc'
        )));

        /*$this->Permission->query("delete from permissions where 1=1;");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleUsers index', 'Módulos: Usuários', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleUsers create', 'Módulos: Usuários', 'Adicionar Usuários', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleUsers update', 'Módulos: Usuários', 'Editar Usuários', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleUsers delete', 'Módulos: Usuários', 'Apagar Usuários', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleRoles index', 'Módulos: Perfis', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleRoles create', 'Módulos: Perfis', 'Adicionar Perfis', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleRoles update', 'Módulos: Perfis', 'Editar Perfis', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleRoles delete', 'Módulos: Perfis', 'Apagar Perfis', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModulePermissions index', 'Módulos: Permissões', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModulePermissions save', 'Módulos: Permissões', 'Alterar Permissões', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities index', 'Módulos: Entidades', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities create', 'Módulos: Entidades', 'Adicionar Entidades', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities update', 'Módulos: Entidades', 'Editar Entidades', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities delete', 'Módulos: Entidades', 'Apagar Entidades', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities view', 'Módulos: Entidades', 'Visualizar Detalhes', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities entities', 'Módulos: Entidades', 'Utilizar Autocomplete de Entidades', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities organizational_structure', 'Módulos: Entidades', 'Utilizar Autocomplete de Estrutura Organizacional', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleMessages index', 'Módulos: Mensagens', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleMessages create', 'Módulos: Mensagens', 'Enviar Mensagens', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleMessages view', 'Módulos: Mensagens', 'Visualizar Detalhes', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleMessages users', 'Módulos: Mensagens', 'Utilizar Autocomplete de Usuários', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleChat getchats', 'Módulos: Chat', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleChat getusers', 'Módulos: Chat', 'Criar novo Chat', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleChat getmessages', 'Módulos: Chat', 'Visualizar Mensagens', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleChat sendmessage', 'Módulos: Chat', 'Enviar Mensagens', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleChat setstatus', 'Módulos: Chat', 'Armazenar Status do Chat', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleChat clear', 'Módulos: Chat', 'Limpar Histórico do Chat', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsUser index', 'Configurações: Minha Conta', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsUser save', 'Configurações: Minha Conta', 'Salvar Alterações', '')");

	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk index', 'Módulos: Helpdesk', 'Acesso ao módulo', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk create', 'Módulos: Helpdesk', 'Criar novo Ticket', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk view', 'Módulos: Helpdesk', 'Visualizar Detalhes', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk users', 'Módulos: Helpdesk', 'Utilizar Autocomplete de Usuários', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk users', 'Módulos: Helpdesk', 'Utilizar Autocomplete de Usuários', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk types', 'Módulos: Helpdesk', 'Utilizar Autocomplete de Tipos de Problemas', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk devices', 'Módulos: Helpdesk', 'Utilizar Autocomplete de Equipamentos', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk answer', 'Módulos: Helpdesk', 'Responder Tickets', '')");

	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdeskTypes index', 'Módulos: Helpdesk - Tipos de Problemas', 'Acesso ao módulo', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdeskTypes create', 'Módulos: Helpdesk - Tipos de Problemas', 'Criar novo Tipo de Problema', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdeskTypes update', 'Módulos: Helpdesk - Tipos de Problemas', 'Editar Tipo de Problema', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdeskTypes delete', 'Módulos: Helpdesk - Tipos de Problemas', 'Apagar Tipo de Problema', '')");

	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdeskDevices index', 'Módulos: Helpdesk - Equipamentos', 'Acesso ao módulo', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdeskDevices create', 'Módulos: Helpdesk - Equipamentos', 'Criar novo Equipamento', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdeskDevices update', 'Módulos: Helpdesk - Equipamentos', 'Editar Equipamento', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdeskDevices delete', 'Módulos: Helpdesk - Equipamentos', 'Apagar Equipamento', '')");

	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk types', 'Módulos: Helpdesk', 'Utilizar Autocomplete de Tipos de Problema', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk devices', 'Módulos: Helpdesk', 'Utilizar Autocomplete de Equipamentos', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleAdmContract index', 'Módulos: Contratos', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleAdmContract create', 'Módulos: Contratos', 'Criar novo contrato', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleAdmContract update', 'Módulos: Contratos', 'Editar contrato', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleAdmContract entities', 'Módulos: Contratos', 'Utilizar autocomplete de entidades', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleAdmContract resultscenters', 'Módulos: Contratos', 'Utilizar autocomplete de centros de resultados', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleAdmContract budgetsaccounts', 'Módulos: Contratos', 'Utilizar autocomplete de contas orçamentárias', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinFaturamento index', 'Módulos: Faturamento', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinFaturamento billings', 'Módulos: Faturamento', 'Notas fiscais', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinFaturamento create', 'Módulos: Faturamento', 'Cadastrar nota fiscal', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinFaturamento update', 'Módulos: Faturamento', 'Editar nota fiscal', '')");


        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions index', 'Módulos: Financeiro', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions create', 'Módulos: Financeiro', 'Criar nova movimentação', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions update', 'Módulos: Financeiro', 'Editar movimentação', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions close', 'Módulos: Financeiro', 'Baixa', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions entities', 'Módulos: Financeiro', 'Utilizar autocomplete de entidades', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions resultscenters', 'Módulos: Financeiro', 'Utilizar autocomplete de centros de resultados', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions budgetsaccounts', 'Módulos: Financeiro', 'Utilizar autocomplete de contas orçamentárias', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions banksaccounts', 'Módulos: Financeiro', 'Utilizar autocomplete de contas bancárias', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleFinTransactions documents', 'Módulos: Financeiro', 'Utilizar autocomplete de tipos de documentos', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsDocumentTypes index', 'Configurações: Tipos de Documentos', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsDocumentTypes create', 'Configurações: Tipos de Documentos', 'Criar tipo de documento', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsDocumentTypes update', 'Configurações: Tipos de Documentos', 'Editar tipo de documento', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsDocumentTypes delete', 'Configurações: Tipos de Documentos', 'Apagar tipo de documento', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsOrganizationalStructure index', 'Configurações: Estrutura Organizacional', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsOrganizationalStructure create', 'Configurações: Estrutura Organizacional', 'Criar unidade organizacional', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsOrganizationalStructure update', 'Configurações: Estrutura Organizacional', 'Editar unidade organizacional', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsOrganizationalStructure delete', 'Configurações: Estrutura Organizacional', 'Apagar unidade organizacional', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBanksAccounts index', 'Configurações: Contas Bancárias', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBanksAccounts create', 'Configurações: Contas Bancárias', 'Criar conta bancária', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBanksAccounts update', 'Configurações: Contas Bancárias', 'Editar conta bancária', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBanksAccounts delete', 'Configurações: Contas Bancárias', 'Apagar conta bancária', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBanksAccounts banks', 'Configurações: Contas Bancárias', 'Utilizar autocomplete de bancos', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBudgetsAccounts index', 'Configurações: Contas Orçamentárias', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBudgetsAccounts update', 'Configurações: Contas Orçamentárias', 'Editar conta orçamentária', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBudgetsAccounts delete', 'Configurações: Contas Orçamentárias', 'Apagar conta orçamentária', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsBudgetsAccounts create', 'Configurações: Contas Orçamentárias', 'Criar conta orçamentária', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsResultsCenters index', 'Configurações: Centro de Resultados', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsResultsCenters create', 'Configurações: Centro de Resultados', 'Criar centro de resultados', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsResultsCenters update', 'Configurações: Centro de Resultados', 'Editar centro de resultados', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsResultsCenters delete', 'Configurações: Centro de Resultados', 'Apagar centro de resultados', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsSystem index', 'Configurações', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsSystem save', 'Configurações', 'Salvar configurações', '')");
         */

        if (isset($_GET['add'])) {
        }

        $this->set('title', 'Módulos > Usuários > Permissões');
    }

    /**
     * Método responsável por editar um perfil já cadastrado. Exibe o formulário
     * preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function save() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('put')) {
            foreach( $this->request->data as $id=>$data ) {
                $roles = array();
                foreach( $data['Roles'] as $role => $checked ) {
                    if ( $checked ) $roles[] = $role;
                }

                $this->Permission->id = $id;
                $this->Permission->read();
                $this->Permission->set('Roles', $roles);

                $this->Permission->save();
            }
        }
    }

}

?>
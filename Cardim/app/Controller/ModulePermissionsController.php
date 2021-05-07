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

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities index', 'Módulos: Clientes', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities create', 'Módulos: Clientes', 'Adicionar Clientes', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities update', 'Módulos: Clientes', 'Editar Clientes', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities delete', 'Módulos: Clientes', 'Apagar Clientes', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities view', 'Módulos: Clientes', 'Visualizar Detalhes', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleEntities entities', 'Módulos: Clientes', 'Utilizar Autocomplete de Clientes', '')");
        

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

	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk index', 'Módulos: Chamados', 'Acesso ao módulo', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk create', 'Módulos: Chamados', 'Criar novo Chamado', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk view', 'Módulos: Chamados', 'Visualizar Detalhes', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk users', 'Módulos: Chamados', 'Utilizar Autocomplete de Usuários', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk users', 'Módulos: Chamados', 'Utilizar Autocomplete de Usuários', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk types', 'Módulos: Chamados', 'Utilizar Autocomplete de Tipos de Problemas', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk devices', 'Módulos: Chamados', 'Utilizar Autocomplete de Equipamentos', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk answer', 'Módulos: Chamados', 'Responder Chamados', '')");


	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleHelpdesk types', 'Módulos: Chamados', 'Utilizar Autocomplete de Tipos de Chamados', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleContract index', 'Módulos: Contratos', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleContract create', 'Módulos: Contratos', 'Criar novo contrato', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleContract update', 'Módulos: Contratos', 'Editar contrato', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleContract entities', 'Módulos: Contratos', 'Utilizar autocomplete de Clientes', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsSystems index', 'Configurações: Tipos de Sistema', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsSystems create', 'Configurações: Tipos de Sistema', 'Criar Tipos de Sistemas', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsSystems update', 'Configurações: Tipos de Sistema', 'Editar Tipos de Sistemas', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsSystems delete', 'Configurações: Tipos de Sistema', 'Apagar Tipos de Sistemas', '')");

        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsTests index', 'Configurações: Tipos de Sistema', 'Acesso ao módulo', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsTests create', 'Configurações: Tipos de Testes', 'Criar Tipos de Testes', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsTests update', 'Configurações: Tipos de Testes', 'Editar Tipos de Testes', '')");
        $this->Permission->query("insert into permissions(action, `group`, name, description) values('SettingsTests delete', 'Configurações: Tipos de Testes', 'Apagar Tipos de Testes', '')");

	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleResults index', 'Módulos: Resultados', 'Acesso ao módulo', '')");
	$this->Permission->query("insert into permissions(action, `group`, name, description) values('ModuleResults view', 'Módulos: Resultados', 'Visualizar Detalhes', '')");

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
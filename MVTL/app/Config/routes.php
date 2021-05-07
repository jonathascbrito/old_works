<?php

/**
 * Define a rota padrão da aplicação.
 */
Router::connect('/', array('controller' => 'app', 'action' => 'login'));
Router::connect('/cron', array('controller' => 'app', 'action' => 'cron'));

Router::connect('/modules/notifications', array('controller' => 'module_notifications', 'action' => 'index'));
Router::connect('/modules/notifications/update', array('controller' => 'module_notifications', 'action' => 'update'));
Router::connect('/modules/notifications/execute/*', array('controller' => 'module_notifications', 'action' => 'execute'));
Router::connect('/modules/notifications/generate/*', array('controller' => 'module_notifications', 'action' => 'generate'));

/**
 * Define as rotas de login, logout e recuperar senha.
 */
Router::connect('/login', array('controller' => 'app', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'app', 'action' => 'logout'));
Router::connect('/reset', array('controller' => 'app', 'action' => 'reset'));

/**
 * Define as rotas do sistema de arquivos.
 */
Router::connect('/upload', array('controller' => 'attachments', 'action' => 'upload'));
Router::connect('/download/*', array('controller' => 'attachments', 'action' => 'download'));

/**
 * Define as rotas para editar e delete objetos do sistema.
 */
Router::connect('/update/*', array('controller' => 'app', 'action' => 'handle_update'));
Router::connect('/delete/*', array('controller' => 'app', 'action' => 'handle_delete'));

/**
 * Define as rotas relacionadas ao dashboard
 */
Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));

/**
 * Define as rotas relacionadas ao chat
 */
Router::connect('/chat/getchats', array('controller' => 'module_chat', 'action' => 'getchats'));
Router::connect('/chat/getusers', array('controller' => 'module_chat', 'action' => 'getusers'));
Router::connect('/chat/getmessages/*', array('controller' => 'module_chat', 'action' => 'getmessages'));
Router::connect('/chat/setstatus/*', array('controller' => 'module_chat', 'action' => 'setstatus'));
Router::connect('/chat/sendmessage/*', array('controller' => 'module_chat', 'action' => 'sendmessage'));
Router::connect('/chat/clear/*', array('controller' => 'module_chat', 'action' => 'clear'));

/**
 * Define as rotas relacionadas ao módulo de mensagens
 */
Router::connect('/modules/messages/create', array('controller' => 'module_messages', 'action' => 'create'));
Router::connect('/modules/messages/users', array('controller' => 'module_messages', 'action' => 'users'));
Router::connect('/modules/messages/view/*', array('controller' => 'module_messages', 'action' => 'view'));
Router::connect('/modules/messages/*', array('controller' => 'module_messages', 'action' => 'index'));

/**
 * Define as rotas relacionadas ao módulo de usuários
 */
Router::connect('/modules/users', array('controller' => 'module_users', 'action' => 'index'));
Router::connect('/modules/users/create', array('controller' => 'module_users', 'action' => 'create'));
Router::connect('/modules/users/update/*', array('controller' => 'module_users', 'action' => 'update'));
Router::connect('/modules/users/delete/*', array('controller' => 'module_users', 'action' => 'delete'));

/**
 * Define as rotas relacionadas ao módulo de entidades
 */
Router::connect('/modules/entities/index', array('controller' => 'module_entities', 'action' => 'index'));
Router::connect('/modules/entities/create', array('controller' => 'module_entities', 'action' => 'create'));
Router::connect('/modules/entities/update/*', array('controller' => 'module_entities', 'action' => 'update'));
Router::connect('/modules/entities/delete/*', array('controller' => 'module_entities', 'action' => 'delete'));

Router::connect('/modules/entities/qentities', array('controller' => 'module_entities', 'action' => 'entities'));
Router::connect('/modules/entities/qorganizational_structure', array('controller' => 'module_entities', 'action' => 'organizational_structure'));

/**
 * Define as rotas relacionadas ao módulo de perfis
 */
Router::connect('/modules/roles', array('controller' => 'module_roles', 'action' => 'index'));
Router::connect('/modules/roles/create', array('controller' => 'module_roles', 'action' => 'create'));
Router::connect('/modules/roles/view/*', array('controller' => 'module_roles', 'action' => 'view'));
Router::connect('/modules/roles/update/*', array('controller' => 'module_roles', 'action' => 'update'));
Router::connect('/modules/roles/delete/*', array('controller' => 'module_roles', 'action' => 'delete'));

/**
 * Define as rotas relacionadas ao módulo de permissões
 */
Router::connect('/modules/permissions', array('controller' => 'module_permissions', 'action' => 'index'));
Router::connect('/modules/permissions/save', array('controller' => 'module_permissions', 'action' => 'save'));

/**
 * Define as rotas relacionadas ao módulo helpdesk
 */
Router::connect('/modules/helpdesk/tickets', array('controller' => 'module_helpdesk', 'action' => 'index'));
Router::connect('/modules/helpdesk/tickets/create', array('controller' => 'module_helpdesk', 'action' => 'create'));
Router::connect('/modules/helpdesk/qusers', array('controller' => 'module_helpdesk', 'action' => 'users'));
Router::connect('/modules/helpdesk/qtypes', array('controller' => 'module_helpdesk', 'action' => 'types'));
Router::connect('/modules/helpdesk/qdevices', array('controller' => 'module_helpdesk', 'action' => 'devices'));

Router::connect('/modules/helpdesk/types', array('controller' => 'module_helpdesk_types', 'action' => 'index'));
Router::connect('/modules/helpdesk/types/create', array('controller' => 'module_helpdesk_types', 'action' => 'create'));
Router::connect('/modules/helpdesk/types/update/*', array('controller' => 'module_helpdesk_types', 'action' => 'update'));
Router::connect('/modules/helpdesk/types/delete/*', array('controller' => 'module_helpdesk_types', 'action' => 'delete'));

Router::connect('/modules/helpdesk/devices', array('controller' => 'module_helpdesk_devices', 'action' => 'index'));
Router::connect('/modules/helpdesk/devices/create', array('controller' => 'module_helpdesk_devices', 'action' => 'create'));
Router::connect('/modules/helpdesk/devices/update/*', array('controller' => 'module_helpdesk_devices', 'action' => 'update'));
Router::connect('/modules/helpdesk/devices/delete/*', array('controller' => 'module_helpdesk_devices', 'action' => 'delete'));

/**
 * Define as rotas relacionadas ao módulo de protocolos
 */
Router::connect('/modules/protocols/create', array('controller' => 'module_protocols', 'action' => 'create'));
Router::connect('/modules/protocols/qusers', array('controller' => 'module_protocols', 'action' => 'users'));
Router::connect('/modules/protocols/*', array('controller' => 'module_protocols', 'action' => 'index'));

/**
 * Define as rotas relacionadas as configurações do sistema e de usuários
 */
Router::connect('/settings/user', array('controller' => 'settings_user', 'action' => 'index'));
Router::connect('/settings/user/save', array('controller' => 'settings_user', 'action' => 'save'));

Router::connect('/settings/system/index', array('controller' => 'settings_system', 'action' => 'index'));
Router::connect('/settings/system/save', array('controller' => 'settings_system', 'action' => 'save'));

Router::connect('/settings/system/banks_accounts', array('controller' => 'settings_banks_accounts', 'action' => 'index'));
Router::connect('/settings/system/banks_accounts/create', array('controller' => 'settings_banks_accounts', 'action' => 'create'));
Router::connect('/settings/system/banks_accounts/update/*', array('controller' => 'settings_banks_accounts', 'action' => 'update'));
Router::connect('/settings/system/banks_accounts/delete/*', array('controller' => 'settings_banks_accounts', 'action' => 'delete'));
Router::connect('/settings/system/banks_accounts/qbanks', array('controller' => 'settings_banks_accounts', 'action' => 'banks'));

Router::connect('/settings/system/budgets_accounts', array('controller' => 'settings_budgets_accounts', 'action' => 'index'));
Router::connect('/settings/system/budgets_accounts/create', array('controller' => 'settings_budgets_accounts', 'action' => 'create'));
Router::connect('/settings/system/budgets_accounts/update/*', array('controller' => 'settings_budgets_accounts', 'action' => 'update'));
Router::connect('/settings/system/budgets_accounts/delete/*', array('controller' => 'settings_budgets_accounts', 'action' => 'delete'));

Router::connect('/settings/system/results_centers', array('controller' => 'settings_results_centers', 'action' => 'index'));
Router::connect('/settings/system/results_centers/create', array('controller' => 'settings_results_centers', 'action' => 'create'));
Router::connect('/settings/system/results_centers/update/*', array('controller' => 'settings_results_centers', 'action' => 'update'));
Router::connect('/settings/system/results_centers/delete/*', array('controller' => 'settings_results_centers', 'action' => 'delete'));

Router::connect('/settings/system/organizational_structure', array('controller' => 'settings_organizational_structure', 'action' => 'index'));
Router::connect('/settings/system/organizational_structure/create', array('controller' => 'settings_organizational_structure', 'action' => 'create'));
Router::connect('/settings/system/organizational_structure/update/*', array('controller' => 'settings_organizational_structure', 'action' => 'update'));
Router::connect('/settings/system/organizational_structure/delete/*', array('controller' => 'settings_organizational_structure', 'action' => 'delete'));

/**
 * Define as rotas relacionadas ao módulo de contratos
 */
Router::connect('/modules/adm/contracts', array('controller' => 'module_adm_contract', 'action' => 'index'));
Router::connect('/modules/adm/contracts/create', array('controller' => 'module_adm_contract', 'action' => 'create'));
Router::connect('/modules/adm/contracts/update/*', array('controller' => 'module_adm_contract', 'action' => 'update'));
Router::connect('/modules/adm/contracts/qentities', array('controller' => 'module_adm_contract', 'action' => 'entities'));
Router::connect('/modules/adm/contracts/qresultscenters', array('controller' => 'module_adm_contract', 'action' => 'resultscenters'));
Router::connect('/modules/adm/contracts/qbudgetsaccounts', array('controller' => 'module_adm_contract', 'action' => 'budgetsaccounts'));

/**
 * Define as rotas relacionadas ao módulo financeiro
 */

Router::connect('/modules/fin/transactions/adiantamentos/create', array('controller' => 'module_fin_adiantamentos', 'action' => 'create'));
Router::connect('/modules/fin/transactions/adiantamentos/update/*', array('controller' => 'module_fin_adiantamentos', 'action' => 'update'));
Router::connect('/modules/fin/transactions/adiantamentos/*', array('controller' => 'module_fin_adiantamentos', 'action' => 'index'));

Router::connect('/modules/fin/transactions/create', array('controller' => 'module_fin_transactions', 'action' => 'create'));
Router::connect('/modules/fin/transactions/update/*', array('controller' => 'module_fin_transactions', 'action' => 'update'));
Router::connect('/modules/fin/transactions/qentities', array('controller' => 'module_fin_transactions', 'action' => 'entities'));
Router::connect('/modules/fin/transactions/qresultscenters', array('controller' => 'module_fin_transactions', 'action' => 'resultscenters'));
Router::connect('/modules/fin/transactions/qbudgetsaccounts', array('controller' => 'module_fin_transactions', 'action' => 'budgetsaccounts'));
Router::connect('/modules/fin/transactions/qbanksaccounts', array('controller' => 'module_fin_transactions', 'action' => 'banksaccounts'));
Router::connect('/modules/fin/transactions/qdocuments', array('controller' => 'module_fin_transactions', 'action' => 'documents'));
Router::connect('/modules/fin/transactions/*', array('controller' => 'module_fin_transactions', 'action' => 'index'));

Router::connect('/modules/fin/faturamento', array('controller' => 'module_fin_faturamento', 'action' => 'index'));
Router::connect('/modules/fin/faturamento/billings', array('controller' => 'module_fin_faturamento', 'action' => 'billings'));
Router::connect('/modules/fin/faturamento/create/*', array('controller' => 'module_fin_faturamento', 'action' => 'create'));
Router::connect('/modules/fin/faturamento/update/*', array('controller' => 'module_fin_faturamento', 'action' => 'update'));

/**
 * Define as rotas relacionadas ao cadastro de tipos de documents.
 */
Router::connect('/settings/system/documenttypes', array('controller' => 'settings_document_types', 'action' => 'index'));
Router::connect('/settings/system/documenttypes/create', array('controller' => 'settings_document_types', 'action' => 'create'));
Router::connect('/settings/system/documenttypes/update/*', array('controller' => 'settings_document_types', 'action' => 'update'));
Router::connect('/settings/system/documenttypes/delete/*', array('controller' => 'settings_document_types', 'action' => 'delete'));

Router::connect('/reports/:action', array('controller' => 'module_reports'));

?>
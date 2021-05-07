<!DOCTYPE html>
<html>

<head>
    <?php echo $this->Html->charset(); ?>
    <?php echo $this->fetch('head'); ?>

    <?php
        echo $this->Html->css('layout.fonts');
        echo $this->Html->css('layout.authenticated');

        echo $this->Html->script('mootools.core');
        echo $this->Html->script('mootools.more');

        echo $this->App->loadmodule('form');
        echo $this->App->loadmodule('autocomplete');

        echo $this->App->loadmodule('message');
        echo $this->App->loadmodule('dropdown');
        echo $this->App->loadmodule('modal');

        echo $this->App->loadmodule('chat');
        echo $this->App->loadmodule('notifications');
        echo $this->App->loadmodule('attachment');
    ?>

    <?php
        echo $this->fetch('modules');
        echo $this->fetch('styles');
        echo $this->fetch('scripts');
    ?>

    <title><?php echo $title; ?></title>
</head>

<body>

    <div id="header">
        <div class="center">
            <div id="logo"></div>
            <div id="menu">
                <?php
                    echo $this->App->createlink('Dashboard', '/dashboard');
                    echo $this->App->createdropdownlink('Módulos<span id="modules-notifications-count"></span>', 'modules');
                    echo $this->App->createdropdownlink('Configurações', 'settings');
                ?>
            </div>
        </div>
    </div>

    <!-- Header Dropdowns -->
    <?php echo $this->App->createdropdownoptions('modules', array(
        'Notificações<span id="notifications-count"></span>' => '/modules/notifications',
        'Mensagens<span id="messages-count"></span>' => '/modules/messages/inbox',
        '-',
        'Usuários' => '/modules/users',
        'Entidades' => '/modules/entities/index',
        '-',
        'Gestão de Pessoas' => '/modules/rh/employees',
        'Administrativo' => '/modules/adm/contracts',
        'Financeiro' => '/modules/fin/transactions/all',
        '-',
        'Helpdesk' => '/modules/helpdesk/tickets',
        'Protocolos' => '/modules/protocols/all'
    )); ?>

    <?php echo $this->App->createdropdownoptions('settings', array(
        'Minha Conta' => '/settings/user',
        'Configurações' => '/settings/system/index',
        '-',
        'Sair' => '/logout'
    )); ?>
    <!-- /Header Dropdowns -->

    <div id="main">
        <div class="center">
            <div class="clearfix"></div>
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->fetch('content'); ?>
            <div class="clearfix"></div>
        </div>
    </div>

    <div id="footer">
        <div class="center">
            <a href="http://www.integrotecnologia.com.br" target="_blank">INTEGRO Tecnologia &copy;</a>

            &nbsp;&nbsp;·&nbsp;&nbsp;

            <?php echo $this->App->createlink('Celular', '/mobile'); ?>
            &nbsp;&nbsp;·&nbsp;&nbsp;
            <?php echo $this->App->createlink('Manual', '/handbook'); ?>
            &nbsp;&nbsp;·&nbsp;&nbsp;
            <?php echo $this->App->createlink('Suporte', '/support'); ?>

            <?php //@todo: links ?>
        </div>
    </div>

</body>

</html>
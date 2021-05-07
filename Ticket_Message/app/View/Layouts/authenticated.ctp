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
            <div id="logo">Cardim Sistemas Contra Incêndio</div>
            <div id="menu">
                <?php
                    //echo $this->App->createlink('Dashboard', '/dashboard');
                    echo $this->App->createdropdownlink('Módulos', 'modules');
                    echo $this->App->createdropdownlink('Configurações', 'settings');
                ?>
            </div>
        </div>
    </div>

    <!-- Header Dropdowns -->
    <?php echo $this->App->createdropdownoptions('modules', array(
        'Mensagens' => '/modules/messages/inbox',
        '-',
        'Usuários' => '/modules/users',
        'Clientes' => '/modules/entities/index',
        '-',
        'Chamados' => '/modules/helpdesk/tickets',
        'Propostas' => '/modules/contracts',
        '-',
        'Relatório' => '/modules/results'
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
            <a href="#" target="_blank">Jonathas Desenvolvimento &copy;</a>

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
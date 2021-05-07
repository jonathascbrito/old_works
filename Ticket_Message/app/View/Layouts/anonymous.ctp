<!DOCTYPE html>
<html>

<head>
    <?php echo $this->Html->charset(); ?>
    <?php echo $this->fetch('head'); ?>

    <?php
        echo $this->Html->css('layout.fonts');
        echo $this->Html->css('layout.anonymous');

        echo $this->Html->script('mootools.core');
        echo $this->Html->script('mootools.more');

        echo $this->App->loadmodule('form');
        echo $this->App->loadmodule('message');
    ?>

    <?php
        echo $this->fetch('modules');
        echo $this->fetch('styles');
        echo $this->fetch('scripts');
    ?>

    <title><?php echo $title; ?></title>
</head>

<body>
    <div id="main">
        <div id="logo"></div>
        <div id="content"><?php echo $this->fetch('content'); ?></div>
    </div>
</body>

<!-- @todo: footer links -->

</html>
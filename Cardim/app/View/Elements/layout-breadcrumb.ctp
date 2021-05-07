<div id="breadcrumb">
    <span class="help"><?php echo $this->App->createlink('Ajuda', '/help'); ?></span>
    <span class="home"><?php echo $this->App->createlink('Módulos', '/'); ?></span>

    <div class="sep"></div>
    <?php echo $this->fetch('breadcrumb'); ?>
</div>
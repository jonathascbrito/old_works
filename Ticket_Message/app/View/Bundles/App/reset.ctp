<div class="form">
    <p>Bem vindo(a)!</p>
    <p>Para continuar informe seu endereço de e-mail no campo abaixo:</p>

    <div class="line"></div>

    <?php echo $this->Session->flash('auth'); ?>

    <form method="post" action="<?php echo $this->App->createurl('/reset'); ?>">

        <?php echo $this->App->createinput('E-mail:', 'User.email'); ?>

        <div class="form-actions right">
            <?php echo $this->App->createlink('voltar', '/login'); ?>
            <?php echo $this->App->createbutton('enviar'); ?>
        </div>

    </form>
</div>
<div class="form">
    <p>Bem vindo(a)!</p>
    <p>Para acessar o sistema da Cardim informe o seu usuário e senha abaixo:</p>

    <div class="line"></div>

    <?php echo $this->Session->flash('auth'); ?>

    <form method="post" action="<?php echo $this->App->createurl('/login'); ?>">

        <?php echo $this->App->createinput('Usuário:', 'User.username'); ?>
        <?php echo $this->App->createinput('Senha:', 'User.password', 'password'); ?>

        <div class="form-actions right">
            <?php echo $this->App->createlink('esqueci minha senha', '/reset'); ?>
            <?php echo $this->App->createbutton('enviar'); ?>
        </div>

    </form>
</div>
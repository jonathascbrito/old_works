<h2>Editar Usuário</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O usuário <?php echo $this->request->data['User']['name']; ?> (<?php echo $this->request->data['User']['username']; ?>) foi atualizado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'User.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Nome', 'User.name'); ?>
            <?php echo $this->App->createinput('E-mail', 'User.email'); ?>
            <?php echo $this->App->createinput('Usuário', 'User.username'); ?>

            <?php
                $this->App->setattribute('default', 1);
                $this->App->setattribute('options', array(1 => 'Ativo', 0 => 'Bloqueado'));
                echo $this->App->createinput('Status', 'User.active', 'radio');
            ?>

            <?php
                $this->App->setattribute('multiple', 'checkbox');
                echo $this->App->createinput('Perfis', 'User.Roles', 'select');
            ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/users/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
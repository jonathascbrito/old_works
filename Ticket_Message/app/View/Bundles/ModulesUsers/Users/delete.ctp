<h2>Apagar Usuário</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O usuário <?php echo $user['User']['name']; ?> (<?php echo $user['User']['username']; ?>) foi apagado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="delete" method="delete">

            <p>Tem certeza de que deseja apagar o usuário <?php echo $user['User']['name']; ?> (<?php echo $user['User']['username']; ?>)?</p>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'delete');
                    echo $this->App->createmodalbutton('Continuar', 'open', '/modules/users/delete/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
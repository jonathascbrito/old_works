<h2>Editar Perfil</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O perfil <?php echo $this->request->data['Role']['name']; ?> foi atualizado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'Role.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Nome', 'Role.name'); ?>
            <?php echo $this->App->createinput('Descrição', 'Role.description', 'textarea'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/roles/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
<h2>Novo Perfil</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O perfil <?php echo $this->request->data['Role']['name']; ?> foi cadastrado!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('Nome', 'Role.name'); ?>
            <?php echo $this->App->createinput('Descrição', 'Role.description', 'textarea'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/roles/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
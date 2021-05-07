<h2>Novo Teste</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O teste <?php echo $this->request->data['Test']['name']; ?> foi cadastrado!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('Nome', 'Test.name'); ?>
            <?php echo $this->App->createinput('Descrição', 'Test.description', 'textarea'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/tests/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
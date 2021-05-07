<h2>Editar Teste</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O teste <?php echo $this->request->data['Test']['name']; ?> foi atualizado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'Test.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Nome', 'Test.name'); ?>
            <?php echo $this->App->createinput('Descrição', 'Test.description', 'textarea'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/tests/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
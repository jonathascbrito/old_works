<h2>Novo Tipo de Documento</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O Tipo de Documento <?php echo $this->request->data['DocumentType']['name']; ?> foi cadastrado!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('Nome', 'DocumentType.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/documenttypes/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
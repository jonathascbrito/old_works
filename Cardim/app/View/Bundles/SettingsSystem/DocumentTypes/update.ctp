<h2>Editar Tipo de Documento</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O Tipo de Documento <?php echo $this->request->data['DocumentType']['name']; ?> foi atualizado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'DocumentType.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Nome', 'DocumentType.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/documenttypes/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
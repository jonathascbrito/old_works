<h2>Apagar Tipo de Documento</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O Tipo de Documento <?php echo $type['DocumentType']['name']; ?> foi apagado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="delete" method="delete">

            <p>Tem certeza de que deseja apagar o tipo de documento <?php echo $type['DocumentType']['name']; ?>?</p>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'delete');
                    echo $this->App->createmodalbutton('Continuar', 'open', '/settings/system/documenttypes/delete/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
<h2>Apagar Entidade</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A Entidade <?php echo $entity['Entity']['name']; ?> foi apagada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="delete" method="delete">

            <p>Tem certeza de que deseja apagar a entidade <?php echo $entity['Entity']['name']; ?>?</p>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'delete');
                    echo $this->App->createmodalbutton('Continuar', 'open', '/modules/entities/delete/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
<h2>Apagar Propostas</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A proposta <?php echo $contract['Contract']['service']; ?> foi apagada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="delete" method="delete">

            <p>Tem certeza de que deseja apagar a proposta <?php echo $contract['Contract']['service']; ?>?</p>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'delete');
                    echo $this->App->createmodalbutton('Continuar', 'open', '/modules/contracts/delete/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
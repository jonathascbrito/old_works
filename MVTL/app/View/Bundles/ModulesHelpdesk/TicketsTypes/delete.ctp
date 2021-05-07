<h2>Apagar Tipo de Problema</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O tipo de problema <?php echo $type['TicketType']['name']; ?> foi apagado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="delete" method="delete">

            <p>Tem certeza de que deseja apagar o tipo de problema <?php echo $type['TicketType']['name']; ?>?</p>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'delete');
                    echo $this->App->createmodalbutton('Continuar', 'open', '/modules/helpdesk/types/delete/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
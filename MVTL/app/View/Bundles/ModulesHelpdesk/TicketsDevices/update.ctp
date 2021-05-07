<h2>Editar Equipamento</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O equipamento <?php echo $this->request->data['TicketDevice']['name']; ?> foi atualizado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'TicketDevice.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Tipo', 'TicketDevice.type'); ?>
            <?php echo $this->App->createinput('Código', 'TicketDevice.code'); ?>
            <?php echo $this->App->createinput('Nome', 'TicketDevice.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/helpdesk/devices/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
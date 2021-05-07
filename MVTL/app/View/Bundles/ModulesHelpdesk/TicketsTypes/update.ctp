<h2>Editar Tipo de Problema</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O tipo de problema <?php echo $this->request->data['TicketType']['name']; ?> foi atualizado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'TicketType.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Nome', 'TicketType.name'); ?>
            <?php echo $this->App->createinput('Descrição', 'TicketType.description', 'textarea'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/helpdesk/types/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
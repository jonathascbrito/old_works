<h2>Novo Ticket</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O novo ticket foi cadastrado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php
                echo $this->App->createinput('', 'Ticket.user_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TicketUserId',
                    'autocomplete-source' => $this->App->createurl('/modules/helpdesk/qusers')
                ));

                echo $this->App->createinput('Solicitante', 'Ticket.user_id_name');
            ?>

            <?php
                echo $this->App->createinput('', 'Ticket.ticket_type_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TicketTicketTypeId',
                    'autocomplete-source' => $this->App->createurl('/modules/helpdesk/qtypes')
                ));

                echo $this->App->createinput('Solicitação', 'Ticket.ticket_type_id_name');
            ?>

            <?php
                echo $this->App->createinput('', 'Ticket.ticket_device_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TicketTicketDeviceId',
                    'autocomplete-source' => $this->App->createurl('/modules/helpdesk/qdevices')
                ));

                echo $this->App->createinput('Equipamento', 'Ticket.ticket_device_id_name');
            ?>

            <?php
                $this->App->setattribute('options', array('Baixa', 'Normal', 'Urgente'));
                echo $this->App->createinput('Prioridade', 'Ticket.priority', 'radio');
            ?>

            <?php echo $this->App->createinput('Descrição', 'Ticket.description', 'textarea'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/helpdesk/tickets/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
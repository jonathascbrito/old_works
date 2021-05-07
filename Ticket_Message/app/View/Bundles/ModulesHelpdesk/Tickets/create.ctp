<h2>Novo Ticket</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A nova O.S. foi cadastrada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php
                echo $this->App->createinput('', 'Ticket.entity_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TicketEntityId',
                    'autocomplete-source' => $this->App->createurl('/modules/helpdesk/qentities')
                ));

                echo $this->App->createinput('Cliente', 'Ticket.entity_id_name');
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
                $this->App->setattribute('options', array('Baixa', 'Normal', 'Urgente'));
                echo $this->App->createinput('Prioridade', 'Ticket.priority', 'radio');
            ?>

            <?php echo $this->App->createinput('Descrição', 'Ticket.description', 'textarea'); ?>
            
            
            <?php
                echo $this->App->createinput('', 'Ticket.user_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TicketUserId',
                    'autocomplete-source' => $this->App->createurl('/modules/helpdesk/qusers')
                ));

                echo $this->App->createinput('Técnico Resp.', 'Ticket.user_id_name');
            ?>
            
            <?php
                $this->App->setattribute('input-mask', '99\/99\/9999');
                echo $this->App->createinput('Data de Atendimento', 'Ticket.service_date');
            ?>
            
            <?php
                $this->App->setattribute('input-mask', '99:99');
                echo $this->App->createinput('Hora do Atendimento', 'Ticket.service_time');
            ?>
            
            

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
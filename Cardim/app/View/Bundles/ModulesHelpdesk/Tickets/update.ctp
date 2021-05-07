<h2>O.S. Nº<?php echo $ticket['Ticket']['code_number']; ?>/<?php echo $ticket['Ticket']['code_year']; ?></h2>

<?php //var_dump($ticket); ?>


<div class="body">
    <?php if (isset($success)) : ?>
        <p>A O.S. <?php echo $this->request->data['Ticket']['code_number']; echo '/'; echo $this->request->date['Ticket']['code_year']; ?> foi atualizada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">
            
            <?php echo $this->App->createinput('', 'Ticket.id', 'hidden'); ?>
            <?php echo $this->App->createinput('', 'Ticket.priority', 'hidden'); ?>
            <?php echo $this->App->createinput('', 'Ticket.description', 'hidden'); ?>
            <?php echo $this->App->createinput('', 'Ticket.service_date', 'hidden'); ?>
            <?php echo $this->App->createinput('', 'Ticket.service_time', 'hidden'); ?>
            <?php echo $this->App->createinput('', 'Ticket.id', 'hidden'); ?>
            <?php echo $this->App->createinput('', 'Ticket.id', 'hidden'); ?>
            <?php echo $this->App->createinput('', 'Ticket.id', 'hidden'); ?>
            <?php echo $this->App->createinput('', 'Ticket.id', 'hidden'); ?>
            
            
            <p><b>Empresa: </b>
            <?php echo $ticket['Entity']['name']; ?></p>

            <br><br>
            <p><b>Prioridade: </b>
                                  
                <?php
                    switch($ticket['Ticket']['priority']):
                        case '0': echo 'Baixa'; break;
                        case '1': echo 'Normal'; break;
                        case '2': echo 'Urgente'; break;
                    endswitch;
                ?>
            </p>
            
            
            <br><br>
            <p><b>Responsável Técnico:</b>
            <?php echo $ticket['User']['name']; ?></p>
            
            <br><br>
            <p><b>Solicitação: </b>
            <?php echo $ticket['Type']['name']; ?></p>
            
            <br><br>
            <p><b>Previsão da Visita:</b>
            <?php echo $ticket['Ticket']['service_date'].' - '.$ticket['Ticket']['service_time']; ?></p>
                
            <br><br>
            
            <p><b>Descrição: </b>
            <?php echo $ticket['Ticket']['description']; ?></p>
                
            <br><br>
            
            <h3>Informações Complementares da Visita Técnica</h3>
            
            <?php
                $this->App->setattribute('multiple', 'checkbox');
                echo $this->App->createinput('Testes Realizados: ', 'Complement.Tests', 'select');
            ?>
            
            <?php
                $this->App->setattribute('input-mask', '99:99');
                echo $this->App->createinput('Horário Inicio', 'Complement.service_ini');
            ?>
            
            <?php
                $this->App->setattribute('input-mask', '99:99');
                echo $this->App->createinput('Horário Fim', 'Complement.service_fim');
            ?>
            
            <?php echo $this->App->createinput('Observação', 'Complement.observation_close', 'textarea'); ?>
                       
            
            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/helpdesk/tickets/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
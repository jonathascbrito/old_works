<h2><?php print $controller_name; ?> &rarr; <?php print $controller_action; ?></h2>

<div id="breadcrumb">

    <div id="links">
         <?php
            echo $this->Html->link( "Ajuda",
                array(
                    "controller"    => "pages",
                    "action"        => "help"
                ),
                array(
                    "class"         => array(
                        "help"
                    )
                )
            );
        ?>
        <div class="sep"></div>
        <?php
            echo $this->Html->link( "Configurações",
                array(
                    "controller"    => "pages",
                    "action"        => "settings"
                ),
                array(
                    "class"         => array(
                        "settings"
                    )
                )
            );
        ?>
    </div>

    <?php
        echo $this->Html->link( "Home",
            array(
                "controller"    => "pages",
                "action"        => "home"
            ),
            array(
                "class"         => array(
                    "home"
                )
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Tickets",
            array(
                "controller"    => "tickets",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Detalhes",
            array(
                "controller"    => "tickets",
                "action"        => "view",
                $ticket['Ticket']['id']
            )
        );
    ?>
</div>



<div class="content">
    <div class="description">
    Utilize esta página para cadastrar ou editar um Ticket.
    </div>

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Ticket",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Ticket.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>
<fieldset>
    <legend>Dados do Solicitante</legend>
    <div class="control-group">
        <label class="control-label" for="TicketEntityId">Nome</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Entity']['name']; ?></div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="TicketEntityPhone">Tel de Contato</label>

        <div class="controls">
            <div class="text"><?php print "(".$ticket['Entity']['phone_area'].")".$ticket['Entity']['phone_number']; ?></div>
        </div>
    </div>
    <div class="control-group">
        <?php //@TODO: Verificar informação pois tabela de entities se encontrava sem informações de email ?>
        <label class="control-label" for="TicketEntityEmail">Email de Contato</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Entity']['email']; ?></div>
        </div>
    </div>
</fieldset>
    

<fieldset>
    <legend>Informações do Ticket</legend>

    <?php

    //@TODO: Verificar uma melhor localização para o botão para editar ou responder

    ?>


    <div class="control-group">
        <label class="control-label" for="TicketNumber">Número</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Ticket']['number']; ?></div>
            <span class="help-block">Número do ticket.</span>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="TicketStatus">Status</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Ticket']['status']; ?></div>

        </div>
    </div>
    
  
    
    <div class="control-group">
        <label class="control-label" for="TicketDate">Data e Horário de Abertura</label>

        <div class="controls">
            <div class="text"><?php print date("d/m/Y - H:i:s", $ticket['Ticket']['created']); ?></div>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="TicketPriority">Prioridade</label>

        <div class="controls">
            <div class="text"><?php if($ticket['Ticket']['priority'] == 'Alta'){ print "Prioridade Alta"; } if($ticket['Ticket']['priority'] == 'Média'){ print "Prioridade Média"; } if( $ticket['Ticket']['priority'] == "Baixa" ){ print "Prioridade Baixa"; } ?></div>
            <span class="help-block">Informe o nível de prioridade</span>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="TicketProblemId">Tipo de Dificuldade</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Problem']['problem']; ?></div>
            <span class="help-block">Informe qual o tipo de dificuldade</span>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="TicketDescription">Descrição</label>
        <div class="controls">
            <textarea class="textarea-ticket" cols="10" rows="10" disabled="disabled"><?php print $ticket['Ticket']['description']; ?></textarea>
            <span class="help-block">Realize uma descrição completa do problema apresentado</span>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="TicketComputerName">Computador</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Computer']['name']; ?></div>
            <span class="help-block">Informe o computador</span>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="TicketDeviceName">Equipamento</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Device']['name']; ?></div>
            <span class="help-block">Informe o equipamento</span>
        </div>
    </div>

</fieldset>

    <!-- VERIFICAR O MOTIVO PELO QUAL Não LOCALIZA A VARIAVEL -->

    <?php if(isset($ticket['TicketAnswer'])): ?>
    <fieldset>
        <legend>Respostas Anteriores</legend>

        <?php


        foreach ($ticket['TicketAnswer'] as $ticketanswer):

            ?>

                    <div class="control-group">
                        <label class="control-label" for="TicketAnswer">Enviada por <?php print $ticketanswer['EntitySender']['name']; ?></label>

                        <div class="controls">
                            <div class="text"><?php print $ticketanswer['answer']; ?></div>
                            <span class="help-block"><?php print date("d/m/Y - H:i:s", $ticketanswer['created']); ?></span>
                        </div>
                    </div>


        <?php endforeach; ?>



    </fieldset>

    <?php endif; ?>


<?php echo $this->Form->end( ); ?>

</div>







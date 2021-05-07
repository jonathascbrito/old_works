<h2><?php print $controller_name; ?> &rarr; <?php print $controller_action; ?></h2>
<?php
$this->start('script');
echo $this->Html->script('mvtl.ticket');
echo $this->Html->script('mvtl.form');

echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js');
$this->end();

$this->start('css');
echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/flick/jquery-ui.css', null, array('inline' => false));
$this->end();

?>


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
        echo $this->Html->link( "Administração",
            array(
                "controller"    => "tickets",
                "action"        => "admin",
                $ticket['Ticket']['id']
            )
        );
    ?>
</div>



<div class="content">
    <div class="description">
    Utilize esta página para administrar um Ticket.
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
            <div class="text"><?php $ticket['Entity']['email']; ?></div>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Informações do Ticket</legend>


    <div class="control-group">
        <label class="control-label" for="TicketStatus">Status</label>

        <div class="controls">


            <?php
                echo $this->Form->input
                (
                    "Ticket.status",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type"  => "select",
                        "options" => array
                        (
                            "Em Andamento" => "Em Andamento",
                            "Aberto" => "Aberto",
                            "Pendente" => "Pendente - Reposição de peça",
                            "Em Analise" => "Em análise",
                            "Fechado" => "Fechado",
                            "Fechado - Indevido" => "Fechado - Indevido"
                        ),
                        'value' => $ticket['Ticket']['status']
                    )
                );
            ?>

            <span class="help-block">Informe o nível de prioridade</span>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="TicketDate">Data e Horário de Abertura</label>

        <div class="controls">
            <div class="text"><?php print date("d/m/Y - H:i:s", $ticket['Ticket']['created']); ?></div>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="TicketNumber">Número</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Ticket']['number']; ?></div>
            <span class="help-block">Número do ticket.</span>
        </div>
    </div>


    <div class="control-group">
    <label class="control-label" for="TicketPriority">Prioridade</label>

        <div class="controls">
            <?php
                echo $this->Form->input
                (
                    "Ticket.priority",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type"  => "select",
                        "options" => array
                        (
                            "Baixa" => "Prioridade Baixa",
                            "Média" => "Prioridade Média",
                            "Alta" => "Prioridade Alta"
                        ),
                        'value' => $ticket['Ticket']['priority']
                    )
                );
            ?>

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
    <label class="control-label" for="TicketComputerId">Computador</label>

    <div class="controls">
        <div class="text"><?php print $ticket['Computer']['name']; ?></div>
    </div>
</div>
    
<div class="control-group">
    <label class="control-label" for="TicketDeviceId">Equipamento</label>

    <div class="controls">
        <div class="text"><?php print $ticket['Device']['name']; ?></div>
    </div>
</div>






</fieldset>

    <?php //@TODO: VERIFICAR POR QUAL MOTIVO VARIAVEL NÃO É LOCALIZADA DE RESPOSTAS ?>

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
                        </div>
                    </div>


        <?php endforeach; ?>



    </fieldset>

    <?php endif; ?>


<fieldset class="closing_observation" style ="display: none; ">

    <legend>Informações de Fechamento</legend>

    <div class="control-group">
        <label class="control-label" for="TicketClosingObservation">Mensagem</label>

        <div class="controls">
            <?php
            echo $this->Form->input
                    (
                    "Ticket.closing_observation", array
                (
                "div" => false,
                "class" => "textarea-ticket",
                "label" => false,
                "type" => "textarea"
                    )
            );
            ?>

        </div>
    </div>

</fieldset>




<fieldset class="answer">
    <legend>Responder</legend>

    <div class="control-group">
        <label class="control-label" for="TicketAnswerAnswer">Mensagem</label>

        <div class="controls">
            <?php
            echo $this->Form->input
                    (
                    "TicketAnswer.answer", array
                (
                "div" => false,
                "class" => "textarea-ticket",
                "label" => false,
                "type" => "textarea"
                    )
            );
            ?>

        </div>
    </div>


</fieldset>




<div class="form-actions">
    <button type="submit" class="btn btn-primary">Responder</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>







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
        echo $this->Html->link( "Editar Ticket",
            array(
                "controller"    => "tickets",
                "action"        => "edit",
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
            <div class="text"><?php print $ticket['Entity']['email']; ?></div>

        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Informações do Ticket</legend>


    <div class="control-group">
        <label class="control-label" for="TicketStatus">Status</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Ticket']['status']; ?></div>
            <span class="help-block">Status do Ticket.</span>
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
            <div class="text"><?php if($ticket['Ticket']['priority'] == 'Alta'){ print "Prioridade Alta"; } if($ticket['Ticket']['priority'] == 'Média'){ print "Prioridade Média"; } if( $ticket['Ticket']['priority'] == "Baixa" ){ print "Prioridade Baixa"; } ?></div>
            <span class="help-block">Informe qual o tipo de dificuldade</span>
        </div>

    </div>

<div class="control-group">
    <label class="control-label" for="TicketProblemId">Tipo de Dificuldade</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Ticket.problem_id",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "select",
                    "options" => $problem
                )
            );
        ?>

        <span class="help-block">Informe qual o tipo de dificuldade</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="TicketDescription">Descrição</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Ticket.description",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "textarea"
                )
            );
        ?>

        <span class="help-block">Realize uma descrição completa do problema apresentado</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TicketComputerId">Nome do computador</label>

    <div class="controls">
        <?php
        
            //$equip = array('Computador'=>array($computer),'Diversos'=>array($device));
            
            
            echo $this->Form->input
            (
                "Ticket.computer_id",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "select",
                    "options" => array("Informe o computador", $computer)
                )
            );
        ?>

        <span class="help-block">Informe qual o computador</span>
    </div>
</div>
    
<div class="control-group">
    <label class="control-label" for="TicketDeviceId">Nome do equipamento</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Ticket.device_id",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "select",
                    "options" => array("Informe o equipamento", $device)
                )
            );
        ?>

        <span class="help-block">Informe qual o equipamento com problema</span>
    </div>
</div>

</fieldset>

<?php
//@TODO: Problema que não está gerando as respostas

if(isset($ticket['TicketAnswer'])):
    ?>
    <fieldset>
        <legend>Respostas Anteriores</legend>

        <?php


        foreach ($ticketanswers['TicketAnswer'] as $ticketanswer):

            ?>

                    <div class="control-group">
                        <label class="control-label" for="TicketAnswer">Enviada por <?php print $ticket['EntitySender']['name']; ?></label>

                        <div class="controls">
                            <div class="text"><?php print $ticket['answer']; ?></div>
                        </div>
                    </div>


        <?php endforeach; ?>



    </fieldset>
<?php endif; ?>
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
    <button type="submit" class="btn btn-primary">Enviar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>







<?php

$this->start( 'script' );
echo $this->Html->script( 'mvtl.form' );
$this->end( );

?>

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
                    "controller"    => "settings",
                    "action"        => "index"
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
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "tickets",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">

    Utilize esta página para cadastrar um novo ticket.
</div>

<div class="content">

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
    <legend>Dados Ticket</legend>

<div class="control-group">
    <label class="control-label" for="TicketEntityId">Solicitante</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Ticket.entity_id",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o nome do solicitante</span>
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
                    )
                )
            );
        ?>

        <span class="help-block">Informe o nível de prioridade</span>
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

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
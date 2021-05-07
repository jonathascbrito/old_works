<?php

$this->start( 'script' );
echo $this->Html->script( 'mvtl.form' );
echo $this->Html->script( 'mvtl.protocol' );
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
        echo $this->Html->link( "Protocolos",
            array(
                "controller"    => "protocols",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Detalhes",
            array(
                "controller"    => "protocols",
                "action"        => "view",
                $protocol['Protocol']['id']
            )
        );
    ?>
</div>



<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Protocol",
        array
        (
            "class" => "form-horizontal"
        )
    );

    echo $this->Form->input( 'Protocol.id', array
        (
            "type" => "hidden",
            "value" => $id
        )
    );

    echo $this->Form->input( 'Protocol.entity_id', array
        (
            "type" => "hidden",
            "value" => $protocol['Protocol']['entity_id']
        )
    );

    echo $this->Form->input( 'Protocol.number', array
        (
            "type" => "hidden",
            "value" => $protocol['Protocol']['number']
        )
    );

    echo $this->Form->input( 'Protocol.type', array
        (
            "type" => "hidden",
            "value" => $protocol['Protocol']['type']
        )
    );
?>

<fieldset>
<legend>Informações do Protocolo</legend>

<div class="control-group">
    <label class="control-label" for="ProtocolNumber">Número</label>

    <div class="controls">
        <div class="text"><?php print $protocol['Protocol']['number']; ?></div>
        <span class="help-block">Número do protocolo.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ProtocolType">Tipo</label>

    <div class="controls">
        <div class="text"><?php print $protocol['Protocol']['type']; ?></div>
        <span class="help-block">Tipo da tramitação do documento.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ProtocolStatus">Status</label>

    <div class="controls">


            <?php
                echo $this->Form->input
                (
                    "Protocol.status",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "options" => array
                        (
                            "Aberto" => "Aberto",
                            "Em andamento" => "Em andamento",
                            "Finalizado" => "Finalizado"
                        ),
                        'value' => $protocol['Protocol']['status']
                    )
                );
            ?>

        <span class="help-block">Situação do protoco.</span>
    </div>
</div>

</fieldset>

<fieldset>
<legend>Remetente</legend>

<div class="control-group">
    <label class="control-label" for="ProtocolSolicitante">Solicitante</label>

    <div class="controls">
        <div class="text"><?php print $protocol['Entity']['name']; ?></div>
        <span class="help-block">Entidade que solicitou o documento.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ProtocolDepartmentId">Setor de Origem</label>

    <div class="controls">
        <div class="text"><?php print $protocol['Department']['name']; ?></div>
        <span class="help-block">O setor de origem do documento.</span>
    </div>
</div>

</fieldset>

<fieldset>
<legend>Destinatário</legend>

<div class="control-group">
    <label class="control-label" for="ProtocolDepartmentIdReceiving">Destino</label>

    <div class="controls">
        <div class="text"><?php print $protocol['DepartmentReceiving']['name']; ?></div>
        <span class="help-block">O setor de origem do documento.</span>
    </div>
</div>
<?php if (isset($protocol['EntityReceiving']['name'])) { ?>

    <div class="control-group">
    <label class="control-label" for="ContractPeriod0BillingdateDay">Responsável pelo recebimento</label>

    <div class="controls">
        <div class="text"><?php print $protocol['EntityReceiving']['name']; ?></div>
    </div>
</div> <?php

} else { ?>

<div class="control-group">
    <label class="control-label" for="ContractPeriod0BillingdateDay">Responsável pelo recebimento</label>

    <div class="controls">
        <div class="text"><?php print $protocol['Protocol']['reponse_receiving_name']; ?></div>
    </div>
</div><?php

} ?>
<div class="control-group">
    <label class="control-label" for="ProtocolCreateData">Data de criação</label>

    <div class="controls">
        <div class="text"><?php print date( "d/m/Y", strtotime($protocol['Protocol']['create_date'])); ?></div>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ProtocolPrevisionDate">Previsão de retorno</label>

    <div class="controls">
        <div class="text"><?php print date( "d/m/Y", strtotime($protocol['Protocol']['prevision_date'])); ?></div>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="ProtocolReturnData">Data de retorno</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Protocol.return_date",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "date",
                    "dateFormat" => "DMY",
                    "disabled" => true,
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>
    </div>
</div>



</fieldset>
<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>
<?php echo $this->Form->end( ); ?>

</div>
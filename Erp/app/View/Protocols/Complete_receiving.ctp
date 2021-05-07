<?php
$this->start('script');
echo $this->Html->script('mvtl.form');
echo $this->Html->script('mvtl.protocol');
$this->end();
?>

<h2><?php print $controller_name; ?> &rarr; <?php print $controller_action; ?></h2>

<div id="breadcrumb">

    <div id="links">
        <?php
        echo $this->Html->link("Ajuda", array(
            "controller" => "pages",
            "action" => "help"
                ), array(
            "class" => array(
                "help"
            )
                )
        );
        ?>
        <div class="sep"></div>
        <?php
        echo $this->Html->link("Configurações", array(
            "controller" => "pages",
            "action" => "settings"
                ), array(
            "class" => array(
                "settings"
            )
                )
        );
        ?>
    </div>

    <?php
    echo $this->Html->link("Home", array(
        "controller" => "pages",
        "action" => "home"
            ), array(
        "class" => array(
            "home"
        )
            )
    );
    ?>
    <div class="arrow"></div>
    <?php
    echo $this->Html->link("Protocolos", array(
        "controller" => "protocols",
        "action" => "index"
            )
    );
    ?>
    <div class="arrow"></div>
    <?php
    echo $this->Html->link("Detalhes", array(
        "controller" => "protocols",
        "action" => "view",
        $protocol['Protocol']['id']
            )
    );
    ?>
</div>



<div class="content">

    <?php echo $this->Session->flash(); ?>

    <?php
    echo $this->Form->create
            (
            "Protocol", array
        (
        "class" => "form-horizontal"
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
            <label class="control-label" for="ProtocolType">Prioridade</label>

            <div class="controls">
                <div class="text"><?php
    if ($protocol['Protocol']['priority'] == "B") {
        print "Baixa";
    } else if ($protocol['Protocol']['priority'] == "N") {
        print "Normal";
    } else {
        print "Urgente";
    }
    ?></div>
                <span class="help-block">Nível de prioridade do protocolo.</span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ProtocolStatus">Status</label>

            <div class="controls">
                <div class="text"><?php print $protocol['Protocol']['status']; ?></div>

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
                <div class="text"><?php if ($protocol['Protocol']['type'] == "Interno") {
                        print $protocol['DepartmentReceiving']['name'];
                    } else {
                        print $protocol['Protocol']['response_receiving_name'];
                    } ?></div>
                <span class="help-block">Destino da solicitação.</span>
            </div>
        </div>
        <div class="control-group" <?php if ($protocol['Protocol']['type'] == 'Externo') {
                        print "style='display: none;'";
                    } ?>>
            <label class="control-label" for="ContractPeriod0BillingdateDay">Responsável pelo recebimento</label>

            <div class="controls">
                <div class="text"><?php print $protocol['EntityReceiving']['name']; ?></div>
                <span class="help-block">Responsável pelo recebimento da solicitação.</span>
            </div>
        </div>

        <div class="control-group" <?php if ($protocol['Protocol']['type'] == 'Interno') {
                        print "style='display: none;'";
                    } ?>>
            <label class="control-label" for="ContractPeriod0BillingdateDay">Responsável pela logística</label>

            <div class="controls">
                <div class="text"><?php print $protocol['EntityLogistic']['name']; ?></div>
                <span class="help-block">Responsável pela tramitação da solicitação.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="ProtocolCreateData">Data de criação</label>

            <div class="controls">
                <div class="text"><?php print date("d/m/Y", strtotime($protocol['Protocol']['create_date'])); ?></div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="ProtocolPrevisionDate">Previsão de retorno</label>

            <div class="controls">
                <div class="text"><?php print date("d/m/Y", strtotime($protocol['Protocol']['prevision_date'])); ?></div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="ProtocolNotice">Observações da solicitação</label>

            <div class="controls">
                <?php
                echo $this->Form->input
                        (
                        "Protocol.notice", array
                    (
                    "div" => false,
                    "label" => false,
                    "type" => "textarea",
                    "class" => "larger"
                        )
                );
                ?>

                <span class="help-block">Empresa/Setor de destino da soliciitação do protocolo.</span>
            </div>
        </div>




    </fieldset>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Finalizar Solicitação</button>
        <button type="button" class="btn">Cancelar</button>
    </div>
<?php echo $this->Form->end(); ?>

</div>
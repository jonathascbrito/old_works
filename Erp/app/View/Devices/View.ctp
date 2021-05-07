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
        echo $this->Html->link( "Computers",
            array(
                "controller"    => "computers",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "computers",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize essa página para visualizar informações do computador.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

    <?php
    echo $this->Form->create
    (
        "Computer",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Computer.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
    <legend>Dados do Computador</legend>


    <div class="control-group">
        <label class="control-label" for="ComputerCode">Código de Registro</label>

        <div class="controls">
            <div class="text"><?php print $computer['Computer']['code']; ?></div>
            <span class="help-block">Código de registro do Computador.</span>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="ComputerOrganizationalUnitId">Setor/Departamento</label>

        <div class="controls">

            <div class="text"><?php print $computer['OrganizationalUnit']['name']; ?></div>
            <span class="help-block">Setor ou departamento pelo qual o computador está lotado.</span>
        </div>
    </div>

<div class="control-group">
    <label class="control-label" for="ComputerName">Nome</label>

        <div class="text"><?php print $computer['Computer']['name']; ?></div>
        <span class="help-block">Nome ou apelido de registro da máquina</span>

    </div>
</div>


</fieldset>

<fieldset>
    <legend>Hardware</legend>

    <div class="control-group">
        <label class="control-label" for="ComputerDisplay">Monitor</label>

        <div class="controls">

            <div class="text"><?php print $computer['Computer']['Display']; ?></div>

            <span class="help-block">Informe marca e/ou modelo do monitor.</span>
        </div>
    </div>

<div class="control-group">
    <label class="control-label" for="ComputerMemory">Memória</label>

    <div class="controls">

        <div class="text"><?php print $computer['Computer']['memory']; ?></div>

        <span class="help-block">Tipo e tamanho da memória do computador</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ComputerOperationalSystem">Sistema Operacional</label>

    <div class="controls">
        <div class="text"><?php print $computer['Computer']['operational_system']; ?></div>

        <span class="help-block">Sistema operacional utilizado na máquina</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerOffice">Pacote Office</label>

    <div class="controls">

        <div class="text"><?php print $computer['Computer']['office']; ?></div>

        <span class="help-block">Pacote office utilizado</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerCpu">Processador</label>

    <div class="controls">

        <div class="text"><?php print $computer['Computer']['cpu']; ?></div>

        <span class="help-block">Marca e modelo da Unidade de Processamento</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerHardDisc">Disco Rígido</label>

    <div class="controls">

        <div class="text"><?php print $computer['Computer']['hard_disc']; ?></div>

        <span class="help-block">Disco rígido da máquina</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerPurchaseDate">Data de Compra</label>

    <div class="controls">
        <div class="text"><?php print $computer['Computer']['purchase_date']; ?></div>

        <span class="help-block">Data de compra do equipamento</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerObservation">Observação</label>

    <div class="controls">

        <div class="text"><?php print $computer['Computer']['observation']; ?></div>

        <span class="help-block">Observações adicionais.</span>
    </div>
</div>


</fieldset>







<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
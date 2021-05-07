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
    Utilize essa página para cadastrar um novo computador.
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
            <?php
                echo $this->Form->input
                (
                    "Computer.code",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => 'text'
                    )
                );
            ?>
        </div>
    </div>

<div class="control-group">
    <label class="control-label" for="ComputerOrganizationalUnitId">Setor/Departamento</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.organizational_unit_id",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "select",
                    "options" => $departments,
                    "class" => array
                    (
                        "span3"
                    )
                )
            );
        ?>

        <span class="help-block">Setor ou departamento pelo qual o computador está lotado.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ComputerName">Nome</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.name",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe caso exista um apelido para a máquina</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerEntityId">Usuário</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.entity_id",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o nome do usuário</span>
    </div>
</div>




</fieldset>

<fieldset>
    <legend>Hardware</legend>

    <div class="control-group">
        <label class="control-label" for="ComputerDisplay">Monitor</label>

        <div class="controls">
            <?php
                echo $this->Form->input
                (
                    "Computer.display",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => 'text'
                    )
                );
            ?>

            <span class="help-block">Informe marca e modelo do monitor.</span>
        </div>
    </div>

<div class="control-group">
    <label class="control-label" for="ComputerMemory">Memória</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.memory",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'text'
                )
            );
        ?>

        <span class="help-block">Informe tipo e tamanho da memória do computador</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ComputerOperationalSystem">Sistema Operacional</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.operational_system",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'text'
                )
            );
        ?>

        <span class="help-block">Informe qual o sistema operacional utilizado na máquina</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerOffice">Pacote Office</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.office",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'text'
                )
            );
        ?>

        <span class="help-block">Informe qual o pacote office utilizado</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerCpu">Processador</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.cpu",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'text'
                )
            );
        ?>

        <span class="help-block">Informe qual o processador</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerHardDisc">Disco Rígido</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.hard_disc",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'text'
                )
            );
        ?>

        <span class="help-block">Informe dados sobre o disco rígido da máquina</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerPurchaseDate">Data de Compra</label>

    <div class="controls">
        <?php
            //@TODO: Verificar a possibilidade de já utilizar um calendário para cadastro da data
            echo $this->Form->input
            (
                "Computer.purchase_date",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'text'
                )
            );
        ?>

        <span class="help-block">Informe data de compra do equipamento</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="ComputerObservation">Observação</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Computer.observation",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "textarea"
                )
            );
        ?>

        <span class="help-block">Caso exista informações adicionais que deseje passar.</span>
    </div>
</div>


</fieldset>







<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
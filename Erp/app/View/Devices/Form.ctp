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
        echo $this->Html->link( "Equipamentos",
            array(
                "controller"    => "devices",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "devices",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize essa página para cadastrar um novo equipamento.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

    <?php
    echo $this->Form->create
    (
        "Device",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Device.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
    <legend>Dados do Equipamento</legend>

    <div class="control-group">
        <label class="control-label" for="DeviceCode">Código de Registro</label>

        <div class="controls">
            <?php
                echo $this->Form->input
                (
                    "Device.code",
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
    <label class="control-label" for="DeviceOrganizationalUnitId">Setor/Departamento</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Device.organizational_unit_id",
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

        <span class="help-block">Setor ou departamento pelo qual o equipamento está lotado.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="DeviceName">Nome</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Device.name",
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
        <label class="control-label" for="DeviceModel">Marca e Modelo</label>

        <div class="controls">
            <?php
                echo $this->Form->input
                (
                    "Device.model",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => 'text'
                    )
                );
            ?>

            <span class="help-block">Informe marca e modelo do equipamento.</span>
        </div>
    </div>


<div class="control-group">
    <label class="control-label" for="DevicePurchaseDate">Data de Compra</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Device.purchase_date",
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
    <label class="control-label" for="DeviceObservation">Observação</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Device.observation",
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
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

        <?php print $this->element('settings-link'); ?>

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
        echo $this->Html->link( "Impostos",
            array(
                "controller"    => "taxes",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "taxes",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para cadastrar ou editar impostos no sistema.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Tax",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Tax.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
    <legend>Dados do Imposto</legend>

<div class="control-group">
    <label class="control-label" for="TaxName">Nome</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Tax.name",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe um nome para o imposto</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TaxValue">Valor</label>

    <div class="controls">
        <div class="input input-prepend">
            <div class="add-on">%</div>
        <?php
            echo $this->Form->input
            (
                "Tax.value",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'text',
                    "class" => array
                    (
                        "span1"
                    )
                )
            );
        ?>
        </div>

        <span class="help-block">Informe o valor do imposto</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TaxBase">Base de Cálculo</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Tax.base",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'select',
                    "options" => array
                    (
                        "Valor Bruto" => "Valor Bruto",
                        "Valor Informado" => "Valor Informado",
                        "Valor da Folha de Pagamento" => "Valor da Folha de Pagamento"
                    )
                )
            );
        ?>

        <span class="help-block">Informe o valor do imposto</span>
    </div>
</div>

</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
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
        echo $this->Html->link( "Contas Orçamentárias",
            array(
                "controller"    => "budgetaccounts",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "budgetaccounts",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para adicionar uma nova conta orçamentária.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "BudgetAccount",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "BudgetAccount.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
    <legend>Dados da Conta Orçamentária</legend>

<div class="control-group">
    <label class="control-label" for="BudgetAccountCode">Código</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "BudgetAccount.code",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe um código no formato xx.xx.xx.xx</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="BudgetAccountName">Nome</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "BudgetAccount.name",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o nome da conta orçamentária</span>
    </div>
</div>

</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
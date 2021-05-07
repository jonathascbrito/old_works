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
        echo $this->Html->link( "Bancos",
            array(
                "controller"    => "banks",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "banks",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para cadastrar ou editar as contas bancárias do escritório.
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
    <legend>Descrição</legend>

<div class="control-group">
    <label class="control-label" for="BankName">Descrição</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Bank.name",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe uma descrição para esta conta</span>
    </div>
</div>
</fieldset>

<fieldset>
    <legend>Dados do Banco</legend>

<div class="control-group">
    <label class="control-label" for="BankBank">Código</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Bank.bank",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o código do banco</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="BankBankName">Nome</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Bank.bank_name",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o nome do banco</span>
    </div>
</div>
</fieldset>

<fieldset>
    <legend>Dados da Conta</legend>

<div class="control-group">
    <label class="control-label" for="BankAgency">Agência</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Bank.agency",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => 'text',
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>

        <span class="help-block">Informe o número da agência</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="BankAgencyDigit">Dígito Verificador da Agência</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Bank.agency_digit",
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

        <span class="help-block">Informe o dígito verificador da agência</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="BankAccount">Conta</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Bank.account",
                array
                (
                    "div" => false,
                    "label" => false,
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>

        <span class="help-block">Informe o número da conta</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="BankAccountDigit">Dígito Verificador da Conta</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Bank.account_digit",
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

        <span class="help-block">Informe o dígito verificador da conta</span>
    </div>
</div>

</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
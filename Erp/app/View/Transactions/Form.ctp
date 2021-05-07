<?php

$this->start( 'script' );
echo $this->Html->script( 'mvtl.form' );
echo $this->Html->script( 'mvtl.transaction' );
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
        echo $this->Html->link( "Movimentações",
            array(
                "controller"    => "transactions",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "transactions",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para adicionar uma nova movimentação ao sistema. Movimentações de faturamento são geradas automaticamente pelo sistema.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Transaction",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Transaction.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
<legend>Dados do Movimento</legend>

<div class="control-group">
    <label class="control-label" for="TransactionBillingdate">Data de Competência</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Transaction.billingdate",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "date",
                    "dateFormat" => "DMY",
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>

        <span class="help-block">Define o período de vigência do contrato, utilizado pelo módulo de faturamento e reajustes</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TransactionDuedate">Data de Vencimento</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Transaction.duedate",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "date",
                    "dateFormat" => "DMY",
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>

        <span class="help-block">Define o período de vigência do contrato, utilizado pelo módulo de faturamento e reajustes</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TransactionEntityId">Entidade</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Transaction.entity_id",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe a entidade relacionada ao movimento</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TransactionType">Tipo</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Transaction.type",
                array
                (
                    "div" => false,
                    "label" => false,
                    "options" => array
                    (
                        "Entrada"  => "Entrada",
                        "Saída"   => "Saída"
                    )
                )
            );
        ?>

        <span class="help-block">Define o tipo do movimento, entrada ou saída</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TransactionValue">Valor</label>

    <div class="controls">
        <div class="input-prepend">
            <div class="add-on">R$</div>
            <?php
                echo $this->Form->input
                (
                    "Transaction.value",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "text",
                        "class" => array
                        (
                            "span2"
                        )
                    )
                );
            ?>
        </div>
    </div>
</div>

<!--div class="control-group">
    <label class="control-label" for="TransactionInterest">Juros</label>

    <div class="controls">
        <div class="input-prepend">
            <div class="add-on">R$</div>
            <?php
                echo $this->Form->input
                (
                    "Transaction.interest",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "text",
                        "class" => array
                        (
                            "span2"
                        )
                    )
                );
            ?>
        </div>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TransactionFines">Multas</label>

    <div class="controls">
        <div class="input-prepend">
            <div class="add-on">R$</div>
            <?php
                echo $this->Form->input
                (
                    "Transaction.fines",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "text",
                        "class" => array
                        (
                            "span2"
                        )
                    )
                );
            ?>
        </div>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TransactionDiscounts">Descontos</label>

    <div class="controls">
        <div class="input-prepend">
            <div class="add-on">R$</div>
            <?php
                echo $this->Form->input
                (
                    "Transaction.discounts",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "text",
                        "class" => array
                        (
                            "span2"
                        )
                    )
                );
            ?>
        </div>
    </div>
</div-->

</fieldset>

<fieldset>
<legend>C. Resultados / C. Orçamentária</legend>

<div class="control-group">
    <label class="control-label" for="TransactionBudgetAccountId">Conta Orçamentária</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Transaction.budget_account_id_in",
                array
                (
                    "div" => false,
                    "label" => false,
                    "class" => array
                    (
                        "span5"
                    ),
                    "options" => $budgetAccountsIn
                )
            );
        ?>
        <?php
            echo $this->Form->input
            (
                "Transaction.budget_account_id_out",
                array
                (
                    "div" => false,
                    "label" => false,
                    "class" => array
                    (
                        "span5"
                    ),
                    "options" => $budgetAccountsOut
                )
            );
        ?>
        <span class="help-block">A vinculação com um plano de contas orçamentárias permite uma identificação mais fácil das receitas e despesas do escritório, possibilitando maior domínio na origem e aplicação dos recursos</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="TransactionResultsCenter0ResultsCenterId">Centro de Resultados</label>

    <div class="controls">
        <div class="ResultsCenter control-dynamic">
            <?php
                echo $this->Form->input
                (
                    "TransactionResultsCenter.0.results_center_id",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "class" => array
                        (
                            "span5"
                        )
                    )
                );
            ?>
            <?php
                echo $this->Form->input
                (
                    "TransactionResultsCenter.0.part",
                    array
                    (
                        "div" => false,
                        "type"=> 'text',
                        "label" => false,
                        "class" => array
                        (
                            "span1"
                        )
                    )
                );
            ?>
            <a href="#" id="addResultsCenter"><i class="icon-plus-sign"></i></a>
        </div>

        <span class="help-block">Os centros de resultados facilitam o acompanhamento do desempenho, pois demonstram as atividades e segmentos que não estão agregando valor de forma satisfatória</span>
    </div>
</div>

</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
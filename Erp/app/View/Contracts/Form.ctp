<?php

$this->start( 'script' );
echo $this->Html->script( 'mvtl.form' );
echo $this->Html->script( 'mvtl.contract' );
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
        echo $this->Html->link( "Contratos",
            array(
                "controller"    => "contracts",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "contracts",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para adicionar um novo contrato ao sistema. Contratos são utilizados para facilitar os processos de feturamento e cobrança do escritóio.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Contract",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Contract.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
<legend>Informações Básicas</legend>

<div class="control-group">
    <label class="control-label" for="ContractEntityId">Entidade</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Contract.entity_id",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe a entidade relacionada ao contrato</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractObject">Objeto</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Contract.object",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "textarea"
                )
            );
        ?>

        <span class="help-block">Descrição sumária do objeto do contrato</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractType">Tipo</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Contract.type",
                array
                (
                    "div" => false,
                    "label" => false,
                    "options" => array
                    (
                        "Êxito"  => "Êxito",
                        "Fixo"   => "Fixo",
                        "Fixo + Êxito"  => "Fixo + Êxito",
                        "Mensal" => "Mensal",
                        "Mensal + Êxito" => "Mensal + Êxito"
                    )
                )
            );
        ?>

        <span class="help-block">Tipo do contrato. Contratos fixos ou por êxitos possuêm um valor único. Para contratos mensais deve ser informado o valor por mês</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractValue0Base">Valor</label>

    <div class="controls">
        <div class="input-prepend">
            <div class="add-on">R$</div>
            <?php
                echo $this->Form->input
                (
                    "ContractValue.0.base",
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
        <span class="help-block">Valor mensal/total do contrato</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractValue0Part">Êxito</label>

    <div class="controls">
        <div class="input-prepend">
            <div class="add-on">~</div>
            <?php
                echo $this->Form->input
                (
                    "ContractValue.0.part",
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
        <span class="help-block">Valor em caso de êxito. Informe uma porcentagem para que o sistema calcule o valor a partir do total do contrato</span>
    </div>
</div>
</fieldset>

<fieldset>
<legend>C. Resultados / C. Orçamentária</legend>

<div class="control-group">
    <label class="control-label" for="ContractBudgetAccountId">Conta Orçamentária</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Contract.budget_account_id",
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
        <span class="help-block">A vinculação com um plano de contas orçamentárias permite uma identificação mais fácil das receitas e despesas do escritório, possibilitando maior domínio na origem e aplicação dos recursos</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractResultsCenterId">Centro de Resultados</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Contract.results_center_id",
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

        <span class="help-block">Os centros de resultados facilitam o acompanhamento do desempenho, pois demonstram as atividades e segmentos que não estão agregando valor de forma satisfatória</span>
    </div>
</div>
</fieldset>

<fieldset>
<legend>Datas</legend>

<div class="control-group">
    <label class="control-label" for="ContractPeriod0StartDay">Início do Contrato</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "ContractPeriod.0.start",
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
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractPeriod0EndDay">Fim do Contrato</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "ContractPeriod.0.end",
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
    <label class="control-label" for="ContractPeriod0BillingdateDay">Data de Emissão da Nota</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "ContractPeriod.0.billingdate",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "day",
                    "class" => array
                    (
                        "span1"
                    )
                )
            );
        ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractPeriod0DuedateDay">Data de Vencimento</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "ContractPeriod.0.duedate",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "day",
                    "class" => array
                    (
                        "span1"
                    )
                )
            );
        ?>
        <span class="help-block">As datas de emissão e vencimento são utilizadas para gerar alertas automáticos para o módulo de faturamento</span>
    </div>
</div>
</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
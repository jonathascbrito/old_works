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
        echo $this->Html->link( "Detalhes",
            array(
                "controller"    => "contracts",
                "action"        => "view",
                $contract['Contract']['id']
            )
        );
    ?>
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
?>

<fieldset>
<legend>Informações Básicas</legend>

<div class="control-group">
    <label class="control-label" for="ContractEntityId">Entidade</label>

    <div class="controls">
        <div class="text"><?php print $contract['Entity']['name']; ?></div>
        <span class="help-block">Entidade relacionada ao contrato</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractObject">Objeto</label>

    <div class="controls">
        <div class="text"><?php print $contract['Contract']['object']; ?></div>
        <span class="help-block">Descrição sumária do objeto do contrato</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractType">Tipo</label>

    <div class="controls">
        <div class="text"><?php print $contract['Contract']['type']; ?></div>
        <span class="help-block">Tipo do contrato. Contratos fixos ou por êxitos possuêm um valor único, contratos mensais definem um valor por mês</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractValue0Base">Valor</label>

    <div class="controls">
        <div class="text">R$ <?php print number_format($contract['ContractValue'][0]['base'], 2, ',', '.'); ?></div>
        <span class="help-block">Valor mensal/total do contrato</span>
    </div>
</div>

<?php
    if ( strstr($contract['Contract']['type'], 'Êxito') )
    {
?>

<div class="control-group">
    <label class="control-label" for="ContractValue0Part">Êxito</label>

    <div class="controls">
        <div class="text">
            <?php
                $part = $contract['ContractValue'][0]['part'];
                $percent = $contract['ContractValue'][0]['part_percent'];

                if ( $percent ) {
                    echo number_format($part, 0, ',', '.') . "%";
                    echo " ( R$ " . number_format($part/100*$contract['ContractValue'][0]['base'], 2, ',', '.') . " )";
                }else{
                    echo "R$ " . number_format($part, 2, ',', '.');
                }
            ?>
        </div>
        <span class="help-block">Valor em caso de êxito</span>
    </div>
</div>

<?php
    }
?>

</fieldset>

<fieldset>
<legend>C. Resultados / C. Orçamentária</legend>

<div class="control-group">
    <label class="control-label" for="ContractBudgetAccountId">Conta Orçamentária</label>

    <div class="controls">
        <div class="text"><?php print $contract['BudgetAccount']['qualified_name']; ?></div>
        <span class="help-block">A vinculação com um plano de contas orçamentárias permite uma identificação mais fácil das receitas e despesas do escritório, possibilitando maior domínio na origem e aplicação dos recursos</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractResultsCenterId">Centro de Resultados</label>

    <div class="controls">
        <div class="text"><?php print $contract['ResultsCenter']['qualified_name']; ?></div>
        <span class="help-block">Os centros de resultados facilitam o acompanhamento do desempenho, pois demonstram as atividades e segmentos que não estão agregando valor de forma satisfatória</span>
    </div>
</div>

</fieldset>

<fieldset>
<legend>Datas</legend>

<div class="control-group">
    <label class="control-label" for="ContractPeriod0StartDay">Vigência</label>

    <div class="controls">
        <div class="text">
            <?php
                echo date( 'd/m/Y', strtotime($contract['ContractPeriod'][0]['start']) );
                echo " à ";
                echo date( 'd/m/Y', strtotime($contract['ContractPeriod'][0]['end']) );
            ?>
        </div>

        <span class="help-block">Período de vigência do contrato, utilizado pelo módulo de faturamento e reajustes</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractPeriod0BillingdateDay">Data de Emissão da Nota</label>

    <div class="controls">
        <div class="text"><?php print $contract['ContractPeriod'][0]['billingdate']; ?></div>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ContractPeriod0DuedateDay">Data de Vencimento</label>

    <div class="controls">
        <div class="text"><?php print $contract['ContractPeriod'][0]['duedate']; ?></div>
        <span class="help-block">As datas de emissão e vencimento são utilizadas para gerar alertas automáticos para o módulo de faturamento</span>
    </div>
</div>
</fieldset>

<?php echo $this->Form->end( ); ?>

</div>
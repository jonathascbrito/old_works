<h2>Relatório / Centros de Resultados</h2>

<div class="body">
    <form id="create" method="post" target="_blank" action="<?php echo $this->Html->url('/reports/resultscenters'); ?>">

        <h3>Período</h3>

        <?php
            $this->App->setattribute('input-mask', '99\/99\/9999');
            echo $this->App->createinput('De', 'Report.start');

            $this->App->setattribute('input-mask', '99\/99\/9999');
            echo $this->App->createinput('À', 'Report.end');
        ?>

        <h3>Status</h3>

        <?php echo $this->App->createinput('Status de Baixa', 'Report.baixa', 'select'); ?>
        <?php echo $this->App->createinput('Valor de Baixa', 'Report.baixa_value', 'select'); ?>

        <h3>Níveis</h3>

        <?php
            $this->App->setattribute('input-mask', '99');
            echo $this->App->createinput('Nível Centros de Resultados', 'Report.br_level');

            $this->App->setattribute('input-mask', '99');
            echo $this->App->createinput('Nível Contas Orçamentárias', 'Report.co_level');
        ?>

        <div class="form-actions right">
            <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
            <?php echo $this->App->createbutton('Salvar', 'submit'); ?>
        </div>

    </form>
</div>
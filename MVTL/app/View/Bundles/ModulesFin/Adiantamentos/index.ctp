<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-protocols.png'); ?>
        <h1>Financeiro</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Movimentações', '/modules/fin/transactions/all'); ?>

        <?php echo $this->App->createlink('Movimentações Diárias', '/modules/fin/transactions/movimentacoes_diarias'); ?>
        <?php echo $this->App->createlink('Provisionadas', '/modules/fin/transactions/provisionadas'); ?>
        <?php echo $this->App->createlink('Aprovadas', '/modules/fin/transactions/aprovadas'); ?>
        <?php echo $this->App->createlink('Vencidas', '/modules/fin/transactions/vencidas'); ?>

        <div style="border-bottom: 1px dotted #ccc; margin: 10px 0;"></div>
        <?php echo $this->App->createlink('Adiantamentos', '/modules/fin/transactions/adiantamentos'); ?>

        <div style="border-bottom: 1px dotted #ccc; margin: 10px 0;"></div>
        <?php echo $this->App->createlink('Faturamento', '/modules/fin/faturamento'); ?>

        <div style="border-bottom: 1px dotted #ccc; margin: 10px 0;"></div>
        <?php echo $this->App->createmodallink('Relatório Centros de Resultados', 'open', '/reports/resultscenters'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Financeiro', '/modules/fin/transactions');
            echo '<div class="sep"></div>';
            echo $this->App->createlink('Adiantamentos', '/modules/fin/transactions/adiantamentos');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Adiantamento', 'open', '/modules/fin/transactions/adiantamentos/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'Transaction.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_fin_adiantamentos'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Transactions.search');
        ?>
        </form>

        <?php echo $this->element('layout-pagination'); ?>
    </div>

    <form id="index">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <?php
                            $this->App->setattribute('type', 'checkbox');
                            $this->App->setattribute('toggleall', 'Transactions.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('id', 'Cod.'); ?></th>
                    <th><?php echo $this->Paginator->sort('description', 'Descrição'); ?></th>
                    <th>Centros de Resultados</th>
                    <th><?php echo $this->Paginator->sort('BudgetAccount.code', 'Conta Orçamentária'); ?></th>
                    <th><?php echo $this->Paginator->sort('Entity.name', 'Entidade'); ?></th>
                    <th><?php echo $this->Paginator->sort('value', 'Valor'); ?></th>
                    <th><?php echo $this->Paginator->sort('baixa_value', 'Pago'); ?></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php $types = array('green', 'red'); ?>
                <?php if ($transactions) { foreach ($transactions as $transaction): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'Transaction.id');

                                echo $this->App->createinput(false, 'toggle.' . $transaction['Transaction']['id']);
                            ?>
                        </td>
                        <td><?php echo $transaction['Transaction']['id']; ?></td>
                        <td><?php echo $transaction['Transaction']['description']; ?></td>
                        <td><?php foreach($transaction['ResultsCenters'] as $resultcenter){
                            echo '<li>' . $resultcenter['qualified_name'] . '</li>';
                        } ?></td>
                        <td><?php echo $transaction['BudgetAccount']['qualified_name']; ?></td>
                        <td><?php echo $transaction['Entity']['name']; ?></td>
                        <td style="color:<?php echo $types[$transaction['Transaction']['type']]; ?>;">R$ <?php echo number_format($transaction['Transaction']['value'], 2, ',', '.'); ?></td>
                        <td><?php echo $transaction['Transaction']['baixa_value'] ? 'R$ ' . number_format($transaction['Transaction']['baixa_value'], 2, ',', '.') : '-'; ?></td>
                        <td><?php echo $transaction['Transaction']['baixa_value'] == $transaction['Transaction']['value'] ? $this->Html->image('check.png') : ''; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($transactions); } ?>
            </tbody>
        </table>
    </form>
</div>
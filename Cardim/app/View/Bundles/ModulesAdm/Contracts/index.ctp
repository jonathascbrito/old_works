<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-protocols.png'); ?>
        <h1>Administrativo</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Contratos', '/modules/adm/contracts'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Administrativo', '/modules/adm/contracts');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Contrato', 'open', '/modules/adm/contracts/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'Contract.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_adm_contract'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Contract.search');
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
                            $this->App->setattribute('toggleall', 'Contract.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('code', 'Código'); ?></th>
                    <th><?php echo $this->Paginator->sort('ResultCenter.code', 'Centro de Resultados'); ?></th>
                    <th><?php echo $this->Paginator->sort('BudgetAccount.code', 'Conta Orçamentária'); ?></th>
                    <th><?php echo $this->Paginator->sort('Entity.name', 'Entidade'); ?></th>
                    <th><?php echo $this->Paginator->sort('type', 'Tipo'); ?></th>
                    <th><?php echo $this->Paginator->sort('value', 'Valor'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php $types = array('Êxito', 'Fixo', 'Fixo + êxito', 'Mensal', 'Mensal + êxito'); ?>
                <?php if ($contracts) { foreach ($contracts as $contract): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'Contract.id');

                                echo $this->App->createinput(false, 'toggle.' . $contract['Contract']['id']);
                            ?>
                        </td>
                        <td><?php echo $contract['Contract']['code_number']; ?>/<?php echo $contract['Contract']['code_year']; ?></td>
                        <td><?php echo $contract['ResultCenter']['qualified_name']; ?></td>
                        <td><?php echo $contract['BudgetAccount']['qualified_name']; ?></td>
                        <td><?php echo $contract['Entity']['name']; ?></td>
                        <td><?php echo $types[$contract['Contract']['type']]; ?></td>
                        <td><?php echo $contract['Contract']['value']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($contracts); } ?>
            </tbody>
        </table>
    </form>
</div>
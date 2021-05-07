<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('settings-system.png'); ?>
        <h1>Configurações</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Parametrização', '/settings/system/index'); ?>
        <?php echo $this->App->createlink('Contas Bancárias', '/settings/system/banks_accounts'); ?>
        <?php echo $this->App->createlink('Contas Orçamentárias', '/settings/system/budgets_accounts'); ?>
        <?php echo $this->App->createlink('Centros de Resultados', '/settings/system/results_centers'); ?>
        <?php echo $this->App->createlink('Estrutura Organizacional', '/settings/system/organizational_structure'); ?>
        <?php echo $this->App->createlink('Tipos de Documentos', '/settings/system/documenttypes'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Configurações', '/settings/system/index');
            echo '<div class="sep"></div>';
            echo $this->App->createlink('Contas Orçamentárias', '/settings/system/budgets_accounts');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Nova Conta Orçamentária', 'open', '/settings/system/budgets_accounts/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'BudgetAccount.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/settings_budgets_accounts'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/settings_budgets_accounts'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'BudgetAccount.search');
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
                            $this->App->setattribute('toggleall', 'BudgetAccount.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('code', 'Código'); ?></th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($budgetsaccounts as $budgetaccount): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'BudgetAccount.id');

                                echo $this->App->createinput(false, 'toggle.' . $budgetaccount['BudgetAccount']['id']);
                            ?>
                        </td>
                        <td><?php echo $budgetaccount['BudgetAccount']['code']; ?></td>
                        <td>
                            <?php
                                $deep = explode('.', $budgetaccount['BudgetAccount']['code']);
                                $deep = count($deep)-1;

                                echo str_repeat('---', $deep) . ($deep > 0 ? '&nbsp;&nbsp;' : '');
                                echo $budgetaccount['BudgetAccount']['name'];
                            ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($budgetsaccounts); ?>
            </tbody>
        </table>
    </form>
</div>
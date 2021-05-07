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
            echo $this->App->createlink('Contas Bancárias', '/settings/system/banks_accounts');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Nova Conta Bancária', 'open', '/settings/system/banks_accounts/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'BankAccount.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/settings_banks_accounts'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/settings_banks_accounts'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'BankAccount.search');
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
                            $this->App->setattribute('toggleall', 'BankAccount.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('bank', 'Banco'); ?></th>
                    <th><?php echo $this->Paginator->sort('agency', 'Agência'); ?></th>
                    <th><?php echo $this->Paginator->sort('account', 'Conta'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($banksaccounts as $bankaccount): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'BankAccount.id');

                                echo $this->App->createinput(false, 'toggle.' . $bankaccount['BankAccount']['id']);
                            ?>
                        </td>
                        <td><?php echo $bankaccount['BankAccount']['name']; ?></td>
                        <td><?php echo $bankaccount['BankAccount']['bank']; ?> - <?php echo SettingsBanksAccountsController::$banks[$bankaccount['BankAccount']['bank']]; ?></td>
                        <td><?php echo $bankaccount['BankAccount']['agency']; ?></td>
                        <td><?php echo $bankaccount['BankAccount']['account']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($banksaccounts); ?>
            </tbody>
        </table>
    </form>
</div>
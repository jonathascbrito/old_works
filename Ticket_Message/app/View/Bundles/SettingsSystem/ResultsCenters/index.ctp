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
            echo $this->App->createlink('Centros de Resultados', '/settings/system/results_centers');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Centro de Resultado', 'open', '/settings/system/results_centers/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'ResultCenter.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/settings_results_centers'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/settings_results_centers'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'ResultCenter.search');
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
                            $this->App->setattribute('toggleall', 'ResultCenter.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('code', 'Código'); ?></th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($resultscenters as $resultcenter): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'ResultCenter.id');

                                echo $this->App->createinput(false, 'toggle.' . $resultcenter['ResultCenter']['id']);
                            ?>
                        </td>
                        <td><?php echo $resultcenter['ResultCenter']['code']; ?></td>
                        <td>
                            <?php
                                $deep = explode('.', $resultcenter['ResultCenter']['code']);
                                $deep = count($deep)-1;

                                echo str_repeat('---', $deep) . ($deep > 0 ? '&nbsp;&nbsp;' : '');
                                echo $resultcenter['ResultCenter']['name'];
                            ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($resultscenters); ?>
            </tbody>
        </table>
    </form>
</div>
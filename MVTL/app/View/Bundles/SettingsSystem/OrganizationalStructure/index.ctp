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
            echo $this->App->createlink('Estrutura Organizacional', '/settings/system/organizational_structure');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Item', 'open', '/settings/system/organizational_structure/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'OrganizationalStructure.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/settings_organizational_structure'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/settings_organizational_structure'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'OrganizationalStructure.search');
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
                            $this->App->setattribute('toggleall', 'OrganizationalStructure.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('code', 'Código'); ?></th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($organizationalstructure as $item): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'OrganizationalStructure.id');

                                echo $this->App->createinput(false, 'toggle.' . $item['OrganizationalStructure']['id']);
                            ?>
                        </td>
                        <td><?php echo $item['OrganizationalStructure']['code']; ?></td>
                        <td>
                            <?php
                                $deep = explode('.', $item['OrganizationalStructure']['code']);
                                $deep = count($deep)-1;

                                echo str_repeat('---', $deep) . ($deep > 0 ? '&nbsp;&nbsp;' : '');
                                echo $item['OrganizationalStructure']['name'];
                            ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($organizationalstructure); ?>
            </tbody>
        </table>
    </form>
</div>
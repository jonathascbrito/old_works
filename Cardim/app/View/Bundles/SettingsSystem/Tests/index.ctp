<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('settings-system.png'); ?>
        <h1>Configurações</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Parametrização', '/settings/system/index'); ?>
        <?php echo $this->App->createlink('Tipos de Chamados', '/settings/system/types'); ?>
        <?php echo $this->App->createlink('Tipos de Testes', '/settings/system/tests'); ?>
        <?php echo $this->App->createlink('Sistemas/Equipamentos', '/settings/system/systems'); ?>
        <?php echo $this->App->createlink('Tipos de Documentos', '/settings/system/documenttypes'); ?>
    </div>
</div>

<div id="content">
    
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Ordem de Serviço', '/modules/helpdesk');
            echo '<div class="sep"></div>';
            echo $this->App->createlink('Tipo de Testes de Equipamentos', '/settings/system/tests');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Teste', 'open', '/settings/system/tests/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'Test.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_tests'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/module_tests'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Test.search');
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
                            $this->App->setattribute('toggleall', 'Test.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('description', 'Descrição'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tests as $test): ?>

                    <tr modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/helpdesk/test/view/' . $test['Test']['id']); ?>">
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'Test.id');

                                echo $this->App->createinput(false, 'toggle.' . $test['Test']['id']);
                            ?>
                        </td>
                        <td><?php echo $test['Test']['name']; ?></td>
                        <td><?php echo $test['Test']['description']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($test); ?>
            </tbody>
        </table>
    </form>
</div>
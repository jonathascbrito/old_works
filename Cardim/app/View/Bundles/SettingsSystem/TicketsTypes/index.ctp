<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('settings-system.png'); ?>
        <h1>Configurações</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Parametrização', '/settings/system/index'); ?>
        <?php echo $this->App->createlink('Tipos de Chamados', '/settings/system/types'); ?>
        <?php echo $this->App->createlink('Sistemas/Equipamentos', '/settings/system/systems'); ?>
        <?php echo $this->App->createlink('Tipos de Documentos', '/settings/system/documenttypes'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Configurações', '/settings/system/index');
            echo '<div class="sep"></div>';
            echo $this->App->createlink('Tipos de Chamados', '/settings/system/types');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Tipo', 'open', '/settings/system/types/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'TicketType.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/settings_types'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/settings_types'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'TicketType.search');
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
                            $this->App->setattribute('toggleall', 'TicketType.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('description', 'Descrição'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($types as $type): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'TicketType.id');

                                echo $this->App->createinput(false, 'toggle.' . $type['TicketType']['id']);
                            ?>
                        </td>
                        <td><?php echo $type['TicketType']['name']; ?></td>
                        <td><?php echo $type['TicketType']['description']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($types); ?>
            </tbody>
        </table>
    </form>
</div>
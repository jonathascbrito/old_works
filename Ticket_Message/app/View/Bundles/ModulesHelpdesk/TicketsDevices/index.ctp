<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-helpdesk.png'); ?>
        <h1>Sistema de O.S.</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Ordens de Serviços', '/modules/helpdesk/tickets'); ?>
        <?php echo $this->App->createlink('Tipos de Chamados', '/modules/helpdesk/types'); ?>
        <?php echo $this->App->createlink('Sistemas', '/modules/helpdesk/devices'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Ordem de Serviço', '/modules/helpdesk');
            echo '<div class="sep"></div>';
            echo $this->App->createlink('Sistemas', '/modules/helpdesk/devices');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Sistema', 'open', '/modules/helpdesk/devices/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'TicketDevice.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_helpdesk_devices'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/module_helpdesk_devices'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'TicketDevice.search');
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
                            $this->App->setattribute('toggleall', 'TicketDevice.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($devices as $device): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'TicketDevice.id');

                                echo $this->App->createinput(false, 'toggle.' . $device['TicketDevice']['id']);
                            ?>
                        </td>
                        <td><?php echo $device['TicketDevice']['name']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($devices); ?>
            </tbody>
        </table>
    </form>
</div>
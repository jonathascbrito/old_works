<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-helpdesk.png'); ?>
        <h1>Helpdesk</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Tickets', '/modules/helpdesk/tickets'); ?>
        <?php echo $this->App->createlink('Tipos de Ticket', '/modules/helpdesk/types'); ?>
        <?php echo $this->App->createlink('Equipamentos', '/modules/helpdesk/devices'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Helpdesk', '/modules/helpdesk');
            echo '<div class="sep"></div>';
            echo $this->App->createlink('Tipos de Ticket', '/modules/helpdesk/types');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Tipo', 'open', '/modules/helpdesk/types/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'TicketType.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_helpdesk_types'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/module_helpdesk_types'); ?>

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
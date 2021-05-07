<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-helpdesk.png'); ?>
        <h1>Sistema O.S.</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Ordens de Serviço', '/modules/helpdesk/tickets'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Ordens de Serviço', '/modules/helpdesk/tickets/pdf_create/1');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Nova O.S.', 'open', '/modules/helpdesk/tickets/create'); ?>
        
        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'Ticket.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_helpdesk'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/module_helpdesk'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Ticket.search');
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
                            $this->App->setattribute('toggleall', 'Ticket.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('Ticket.code_number', 'Código'); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.code_year', 'Ano'); ?></th>
                    <th><?php echo $this->Paginator->sort('Entity.name', 'Cliente'); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.priority', 'Prioridade'); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.status', 'Status'); ?></th>
                    <th><?php echo $this->Paginator->sort('User.name', 'Técnico'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                
                    <tr modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/helpdesk/tickets/view/' . $ticket['Ticket']['id']); ?>">
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'Ticket.id');

                                echo $this->App->createinput(false, 'toggle.' . $ticket['Ticket']['id']);
                            ?>
                        </td>
                        <td><?php echo $ticket['Ticket']['code_number']; ?></td>
                        <td><?php echo $ticket['Ticket']['code_year']; ?></td>
                        <td><?php echo $ticket['Entity']['name']; ?></td>
                        <td>
                            <?php
                                switch($ticket['Ticket']['priority']):
                                    case '0': echo 'Baixa'; break;
                                    case '1': echo 'Normal'; break;
                                    case '2': echo 'Urgente'; break;
                                endswitch;
                            ?>
                        </td>
                        <td><?php echo $ticket['Ticket']['status']; ?></td>
                        <td><?php echo $ticket['User']['name']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($tickets); ?>
            </tbody>
        </table>
    </form>
</div>
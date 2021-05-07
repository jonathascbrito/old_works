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
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Ticket', 'open', '/modules/helpdesk/tickets/create'); ?>

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
                    <th><?php echo $this->Paginator->sort('Ticket.code_number', 'Código'); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.code_year', 'Ano'); ?></th>
                    <th><?php echo $this->Paginator->sort('Type.name', 'Tipo'); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.priority', 'Prioridade'); ?></th>
                    <th><?php echo $this->Paginator->sort('Ticket.status', 'Status'); ?></th>
                    <th><?php echo $this->Paginator->sort('User.name', 'Solicitante'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tickets as $ticket): ?>

                    <tr>
                        <td><?php echo $ticket['Ticket']['code_number']; ?></td>
                        <td><?php echo $ticket['Ticket']['code_year']; ?></td>
                        <td><?php echo $ticket['Type']['name']; ?></td>
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
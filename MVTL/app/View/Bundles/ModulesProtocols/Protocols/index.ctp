<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-protocols.png'); ?>
        <h1>Protocolos</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Todos', '/modules/protocols/all'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Protocolos', '/modules/protocols/all');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Protocolo', 'open', '/modules/protocols/create'); ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Protocol.search');
        ?>
        </form>

        <?php echo $this->element('layout-pagination'); ?>
    </div>

    <form id="index">
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('Protocol.code_number', 'Código'); ?></th>
                    <th><?php echo $this->Paginator->sort('Protocol.code_year', 'Ano'); ?></th>
                    <th><?php echo $this->Paginator->sort('Protocol.type', 'Tipo'); ?></th>
                    <th><?php echo $this->Paginator->sort('Protocol.priority', 'Prioridade'); ?></th>
                    <th><?php echo $this->Paginator->sort('From.name', 'Remetente'); ?></th>
                    <th><?php echo $this->Paginator->sort('To.name', 'Destinatário'); ?></th>
                    <th><?php echo $this->Paginator->sort('Protocol.status', 'status'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($protocols as $protocol): ?>

                    <tr>
                        <td><?php echo $protocol['Protocol']['code_number']; ?></td>
                        <td><?php echo $protocol['Protocol']['code_year']; ?></td>
                        <td><?php echo $protocol['Protocol']['type']; ?></td>
                        <td>
                            <?php
                                switch($protocol['Protocol']['priority']):
                                    case '0': echo 'Baixa'; break;
                                    case '1': echo 'Normal'; break;
                                    case '2': echo 'Urgente'; break;
                                endswitch;
                            ?>
                        </td>
                        <td><?php echo $protocol['From']['name']; ?></td>
                        <td><?php echo $protocol['To']['name']; ?></td>
                        <td><?php echo $protocol['Protocol']['status']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($protocols); ?>
            </tbody>
        </table>
    </form>
</div>
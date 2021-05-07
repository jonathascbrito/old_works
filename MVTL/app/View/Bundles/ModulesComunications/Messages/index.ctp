<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-messages.png'); ?>
        <h1>Mensagens</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Inbox', '/modules/messages/inbox'); ?>
        <?php echo $this->App->createlink('Enviadas', '/modules/messages/sended'); ?>
        <?php echo $this->App->createlink('Recebidas', '/modules/messages/received'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Mensagens', '/modules/messages');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Nova Mensagem', 'open', '/modules/messages/create'); ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Message.search');
        ?>
        </form>

        <?php echo $this->element('layout-pagination'); ?>
    </div>

    <form id="index">
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('From.name', 'De'); ?></th>
                    <th><?php echo $this->Paginator->sort('To.name', 'Para'); ?></th>
                    <th><?php echo $this->Paginator->sort('subject', 'Assunto'); ?></th>
                    <th><?php echo $this->Paginator->sort('created', 'Data'); ?></th>
                    <th><?php echo $this->Paginator->sort('readed', 'Lida'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($messages as $message): ?>

                    <tr modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/messages/view/' . $message['Message']['id']); ?>">
                        <td><?php echo $message['From']['name']; ?></td>
                        <td><?php echo $message['To']['name']; ?></td>
                        <td><?php echo $message['Message']['subject']; ?></td>
                        <td><?php echo $this->App->createdate($message['Message']['created']); ?></td>
                        <td>
                            <?php
                                echo $message['Message']['readed'] == '1' ? $this->Html->image('check.png') : '';
                            ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($messages); ?>
            </tbody>
        </table>
    </form>
</div>
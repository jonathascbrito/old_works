<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-notifications.png'); ?>
        <h1>Notificações</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Todas', '/modules/notifications'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Notificações', '/modules/notifications');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">

    </div>
    
    <form id="index">
        <table class="table">
            <tbody>
                <?php foreach ($notifications as $notification): ?>

                    <tr>
                        <td style="cursor:pointer;" modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/notifications/execute/' . $notification['Notification']['id']); ?>">
                            <?php echo $notification['Notification']['message']; ?>
                            <div style="color: #999999;"><small><?php echo date('d/m/Y', strtotime($notification['Notification']['date'])); ?></small></div>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($users); ?>
            </tbody>
        </table>
    </form>
</div>
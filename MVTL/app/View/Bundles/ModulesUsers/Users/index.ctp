<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-users.png'); ?>
        <h1>Usuários</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Usuários', '/modules/users'); ?>
        <?php echo $this->App->createlink('Perfis', '/modules/roles'); ?>
        <?php echo $this->App->createlink('Permissões', '/modules/permissions'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Usuários', '/modules/users');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Usuário', 'open', '/modules/users/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'User.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_users'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/module_users'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'User.search');
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
                            $this->App->setattribute('toggleall', 'User.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('id', 'Cod.'); ?></th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('email', 'E-mail'); ?></th>
                    <th><?php echo $this->Paginator->sort('username', 'Usuário'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'User.id');

                                if ($user['User']['id'] == '1') {
                                    $this->App->setattribute('disabled', 'disabled');
                                }

                                echo $this->App->createinput(false, 'toggle.' . $user['User']['id']);
                            ?>
                        </td>
                        <td><?php echo $user['User']['id']; ?></td>
                        <td><?php echo $user['User']['name']; ?></td>
                        <td><?php echo $user['User']['email']; ?></td>
                        <td><?php echo $user['User']['username']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($users); ?>
            </tbody>
        </table>
    </form>
</div>
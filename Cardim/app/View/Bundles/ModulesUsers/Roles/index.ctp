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
            echo '<div class="sep"></div>';
            echo $this->App->createlink('Perfis', '/modules/roles');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Perfil', 'open', '/modules/roles/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'Role.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_roles'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/module_roles'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Role.search');
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
                            $this->App->setattribute('toggleall', 'Role.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('description', 'Descrição'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($roles as $role): ?>

                    <tr modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/roles/view/' . $role['Role']['id']); ?>">
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'Role.id');

                                echo $this->App->createinput(false, 'toggle.' . $role['Role']['id']);
                            ?>
                        </td>
                        <td><?php echo $role['Role']['name']; ?></td>
                        <td><?php echo $role['Role']['description']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($roles); ?>
            </tbody>
        </table>
    </form>
</div>
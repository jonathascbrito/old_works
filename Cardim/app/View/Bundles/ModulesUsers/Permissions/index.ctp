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
            echo $this->App->createlink('Permissões', '/modules/permissions');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php
            $this->App->setattribute('modal-data', 'index');
            echo $this->App->createmodalbutton('Salvar', 'open', '/modules/permissions/save');
        ?>
    </div>

    <form id="index" method="put">
        <table class="table">
            <tbody>
        <?php $group = false; ?>
        <?php foreach ($permissions as $permission): ?>

            <?php if ( $group != $permission['Permission']['group'] ): ?>
                <thead>
                    <tr>
                        <th colspan="<?php echo count($roles)+1; ?>"></th>
                    </tr>
                    <tr>
                        <th><?php echo $permission['Permission']['group']; ?></th>
                        <?php foreach ( $roles as $role ) : ?>
                            <th class="align-center"><span style="font-weight: normal;"><?php echo $role; ?></span></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <?php $group = $permission['Permission']['group']; ?>
            <?php endif; ?>

            <tr>
                <td>
                    <?php echo $permission['Permission']['name']; ?>
                    <div class="help-block"><?php echo $permission['Permission']['description']; ?></div>
                </td>

                <?php
                    foreach ( $roles as $id=>$role ) :
                        $checked = false;
                        foreach( $permission['Roles'] as $prole ){
                            if ( $prole['id'] == $id ) {
                                $checked = true;
                                break;
                            }
                        }

                        ?><td class="valign-center align-center"><?php

                            $this->App->setattribute('type', 'checkbox');
                            $this->App->setattribute('checked', $checked);

                            echo $this->App->createinput(false, $permission['Permission']['id'] . '.Roles.' . $id);

                        ?></td><?php
                    endforeach;
                ?>
            </tr>

            <?php endforeach; ?>
            <?php unset($roles); ?>
            <?php unset($permissions); ?>
            </tbody>
        </table>
    </form>
</div>
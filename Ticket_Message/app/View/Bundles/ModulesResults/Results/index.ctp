<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-entities.png'); ?>
        <h1>Relatórios</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Todas', '/modules/results/index'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Relatórios', '/modules/results');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'Entity.id');
            $this->App->retainattributes(true);
        ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Entity.search');
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
                            $this->App->setattribute('toggleall', 'Entity.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('contact', 'Contato'); ?></th>
                    <th><?php echo $this->Paginator->sort('phone', 'Tel Contato'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($entities as $entity): ?>
                

                    <tr modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/results/view/' . $entity['Entity']['id']); ?>">
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'Entity.id');

                                echo $this->App->createinput(false, 'toggle.' . $entity['Entity']['id']);
                            ?>
                        </td>
                        <td><?php echo $entity['Entity']['name']; ?></td>
                        <td><?php echo $entity['Entity']['contact']; ?></td>
                        <td><?php echo $entity['Entity']['phone']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($entities); ?>
            </tbody>
        </table>
    </form>
</div>
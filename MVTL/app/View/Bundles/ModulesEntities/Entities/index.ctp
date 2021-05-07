<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-entities.png'); ?>
        <h1>Entidades</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Todas', '/modules/entities/index'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Entidades', '/modules/entities');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Nova Entidade', 'open', '/modules/entities/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'Entity.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/module_entities'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/module_entities'); ?>

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
                    <th><?php echo $this->Paginator->sort('id', 'Cod.'); ?></th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('type', 'tipo'); ?></th>
                    <th><?php echo $this->Paginator->sort('number', 'CPF/CNPJ'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($entities as $entity): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'Entity.id');

                                echo $this->App->createinput(false, 'toggle.' . $entity['Entity']['id']);
                            ?>
                        </td>
                        <td><?php echo $entity['Entity']['id']; ?></td>
                        <td><?php echo $entity['Entity']['name']; ?></td>
						<?php if($entity['Entity']['type'] == 'Gr') { ?>
							<td colspan="2">Grupo</td>
						<?php }else{ ?>
							<td><?php echo $entity['Entity']['type']; ?></td>
							<td><?php echo $entity['Entity']['number']; ?></td>
						<?php } ?>
                    </tr>

                <?php endforeach; ?>
                <?php unset($entities); ?>
            </tbody>
        </table>
    </form>
</div>
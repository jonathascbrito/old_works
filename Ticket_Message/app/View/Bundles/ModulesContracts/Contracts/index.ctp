<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('modules-protocols.png'); ?>
        <h1>Propostas</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Todos', '/modules/contracts/all'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Propostas', '/modules/contracts/all');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Nova Proposta', 'open', '/modules/contracts/create'); ?>
        
        
        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'Contract.id');
            $this->App->retainattributes(true);
        ?>

        <?php //echo $this->App->createmodalbutton('Editar', 'open', '/update/module_contracts'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/module_contracts'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'Contract.search');
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
                            $this->App->setattribute('toggleall', 'Contract.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    
                    <th><?php echo $this->Paginator->sort('Entity.name', 'Cliente'); ?></th>
                    <th><?php echo $this->Paginator->sort('Contract.service', 'Serviço'); ?></th>
                    <th><?php echo $this->Paginator->sort('Contract.date', 'Data'); ?></th>
                    <th><?php echo $this->Paginator->sort('Contract.description', 'Descrição'); ?></th>
                    <th><?php echo $this->Paginator->sort('Contract.situation', 'Situação'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($contracts as $contract): ?>

                    <tr modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/contracts/view/' . $contract['Contract']['id']); ?>">
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'Contract.id');

                                echo $this->App->createinput(false, 'toggle.' . $contract['Contract']['id']);
                            ?>
                        </td>
                        <td><?php echo $contract['Entity']['name']; ?></td>
                        <td><?php echo $contract['Contract']['service']; ?></td>
                        <td><?php echo $contract['Contract']['date']; ?></td>
                        <td><?php echo $contract['Contract']['description']; ?></td>
                        <td>
                            <?php
                                switch($contract['Contract']['situation']):
                                    case '0': echo 'Em Análise'; break;
                                    case '1': echo 'Aceita'; break;
                                    case '2': echo 'Recusada'; break;
                                endswitch;
                            ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($contracts); ?>
            </tbody>
        </table>
    </form>
</div>
<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('settings-system.png'); ?>
        <h1>Configurações</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Parametrização', '/settings/system/index'); ?>
        <?php echo $this->App->createlink('Tipos de Chamados', '/settings/system/types'); ?>
        <?php echo $this->App->createlink('Tipos de Testes', '/settings/system/tests'); ?>
        <?php echo $this->App->createlink('Sistemas/Equipamentos', '/settings/system/systems'); ?>
        <?php echo $this->App->createlink('Tipos de Documentos', '/settings/system/documenttypes'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Configurações', '/settings/system/index');
            echo '<div class="sep"></div>';
            echo $this->App->createlink('Tipos de Documento', '/settings/system/documenttypes');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php echo $this->App->createmodalbutton('Novo Tipo de Documento', 'open', '/settings/system/documenttypes/create'); ?>

        <?php
            $this->App->setattribute('modal-data', 'index');
            $this->App->setattribute('togglecondition', 'DocumentType.id');
            $this->App->retainattributes(true);
        ?>

        <?php echo $this->App->createmodalbutton('Editar', 'open', '/update/settings_document_types'); ?>
        <?php echo $this->App->createmodalbutton('Apagar', 'open', '/delete/settings_document_types'); ?>

        <?php
            $this->App->retainattributes(false);
            $this->App->resetattributes();
        ?>

        <form class="search" id="search" method="post">
        <?php
            echo $this->App->setattribute('autosize', '250px');
            echo $this->App->createinput(false, 'DocumentType.search');
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
                            $this->App->setattribute('toggleall', 'DocumentType.id');

                            echo $this->App->createinput(false, 'toggleall');
                        ?>
                    </th>
                    <th><?php echo $this->Paginator->sort('name', 'Nome'); ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($types as $type): ?>

                    <tr>
                        <td>
                            <?php
                                $this->App->setattribute('type', 'checkbox');
                                $this->App->setattribute('toggle', 'DocumentType.id');

                                echo $this->App->createinput(false, 'toggle.' . $type['DocumentType']['id']);
                            ?>
                        </td>
                        <td><?php echo $type['DocumentType']['name']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($types); ?>
            </tbody>
        </table>
    </form>
</div>
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
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php
            $this->App->setAttribute('modal-data', 'index');
            echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/save');
        ?>
    </div>

    <form id="index">
        <table class="table">
            <thead>
                <tr>
                    <th>Parâmetro</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($settings as $setting): ?>

                <tr>
                    <td>
                        <?php echo $setting['Setting']['description']; ?>
                        <?php

                            if ($setting['Setting']['helpblock']) {
                                echo '<div class="helpblock">' . $setting['Setting']['helpblock'] . '</div>';
                            }

                        ?>
                    </td>
                    <td>
                        <?php
                            echo $this->App->createinput(
                                false,
                                'Settings.' . $setting['Setting']['id'] . '.id',
                                'hidden',
                                $setting['Setting']['id']
                            );

                            if ($setting['Setting']['mask']) {
                                $this->App->setattribute('input-mask', $setting['Setting']['mask']);
                            }

                            if ($setting['Setting']['options']) {
                                $this->App->setattribute('options', json_decode($setting['Setting']['options'], true));
                            }

                            echo $this->App->createinput(
                                false,
                                'Settings.' . $setting['Setting']['id'] . '.value',
                                $setting['Setting']['type'],
                                $setting['Setting']['value']
                            );
                        ?>
                    </td>
                </tr>

                <?php endforeach; ?>
                <?php unset($setting); ?>
            </tbody>
        </table>
    </form>
</div>
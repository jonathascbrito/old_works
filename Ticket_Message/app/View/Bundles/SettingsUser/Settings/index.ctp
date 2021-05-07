<div id="sidebar">
    <div id="title">
        <?php echo $this->Html->image('settings-system.png'); ?>
        <h1>Minha Conta</h1>
    </div>

    <div id="menu">
        <?php echo $this->App->createlink('Alterar Minha Senha', '/settings/user'); ?>
    </div>
</div>

<div id="content">
    <?php
        $this->start('breadcrumb');
            echo $this->App->createlink('Minha Conta', '/settings/user');
        $this->end();

        echo $this->element('layout-breadcrumb');
    ?>

    <div id="actions">
        <?php
            $this->App->setAttribute('modal-data', 'index');
            echo $this->App->createmodalbutton('Salvar', 'open', '/settings/user/save');
        ?>
    </div>

    <form id="index">
        <table class="table">
            <tbody>
               
                <tr>
                    <td>
                        Nova Senha
                    </td>
                    <td>
                        <?php
                            echo $this->App->createinput(
                                false,
                                'User.password',
                                'password'
                            );
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        Repetir Senha
                    </td>
                    <td>
                        <?php
                            echo $this->App->createinput(
                                false,
                                'User.confirm',
                                'password'
                            );
                        ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </form>
</div>
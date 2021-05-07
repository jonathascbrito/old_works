<h2>Nova Entidade</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A entidade <?php echo $this->request->data['Entity']['name']; ?> foi cadastrada!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('Nome', 'Entity.name'); ?>

            <?php echo $this->App->createinput('Contato', 'Entity.contact'); ?>

            <?php echo $this->App->createinput('E-mail', 'Entity.email'); ?>

            <?php
                $this->App->setattribute('input-mask', '\(99\)\ 9999\-9999');
                echo $this->App->createinput('Telefone', 'Entity.phone');
            ?>
            <?php
                $this->App->setattribute('input-mask', '\(99\)\ 9999\-9999');
                echo $this->App->createinput('Celular', 'Entity.cellphone');
            ?>

            <?php echo $this->App->createinput('Endereço', 'Entity.address', 'textarea'); ?>
            
            
            <?php
                $this->App->setattribute('multiple', 'checkbox');
                echo $this->App->createinput('Sistemas', 'Entity.Systems', 'select');
            ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/entities/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
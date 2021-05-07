<h2>Novo Item da Estrutura Organizacional</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O item <?php echo $this->request->data['OrganizationalStructure']['name']; ?> foi cadastrado!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('Código', 'OrganizationalStructure.code'); ?>
            <?php echo $this->App->createinput('Nome', 'OrganizationalStructure.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/organizational_structure/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
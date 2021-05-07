<h2>Editar Item da Estrutura Organizacional</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O item <?php echo $this->request->data['OrganizationalStructure']['name']; ?> foi atualizado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'OrganizationalStructure.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Código', 'OrganizationalStructure.code'); ?>
            <?php echo $this->App->createinput('Nome', 'OrganizationalStructure.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/organizational_structure/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
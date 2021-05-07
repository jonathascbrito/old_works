<h2>Editar Centro de Resultados</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O Centro de Resultados <?php echo $this->request->data['ResultCenter']['name']; ?> foi atualizado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'ResultCenter.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Código', 'ResultCenter.code'); ?>
            <?php echo $this->App->createinput('Nome', 'ResultCenter.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/results_centers/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
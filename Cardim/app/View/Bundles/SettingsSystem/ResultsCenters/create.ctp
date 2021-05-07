<h2>Novo Centro de Resultados</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O Centro de Resultados <?php echo $this->request->data['ResultCenter']['name']; ?> foi cadastrado!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('Código', 'ResultCenter.code'); ?>
            <?php echo $this->App->createinput('Nome', 'ResultCenter.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/results_centers/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
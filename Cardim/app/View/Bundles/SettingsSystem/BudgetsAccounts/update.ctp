<h2>Editar Conta Orçamentária</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A Conta Orçamentária <?php echo $this->request->data['BudgetAccount']['name']; ?> foi atualizada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'BudgetAccount.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Código', 'BudgetAccount.code'); ?>
            <?php echo $this->App->createinput('Nome', 'BudgetAccount.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/budgets_accounts/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
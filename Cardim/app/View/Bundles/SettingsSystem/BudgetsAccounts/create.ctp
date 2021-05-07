<h2>Nova Conta Orçamentária</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A Conta Orçamentária <?php echo $this->request->data['BudgetAccount']['name']; ?> foi cadastrada!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('Código', 'BudgetAccount.code'); ?>
            <?php echo $this->App->createinput('Nome', 'BudgetAccount.name'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/budgets_accounts/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
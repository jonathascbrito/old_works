<h2>Apagar Conta Orçamentária</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A Conta Orçamentária <?php echo $budgetaccount['BudgetAccount']['name']; ?> foi apagada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="delete" method="delete">

            <p>Tem certeza de que deseja apagar a conta orçamentária <?php echo $budgetaccount['BudgetAccount']['name']; ?>?</p>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'delete');
                    echo $this->App->createmodalbutton('Continuar', 'open', '/settings/system/budgets_accounts/delete/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
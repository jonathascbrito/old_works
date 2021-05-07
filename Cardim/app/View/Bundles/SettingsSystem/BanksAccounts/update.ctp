<h2>Editar Conta Bancária</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A Conta Bancária <?php echo $this->request->data['BankAccount']['name']; ?> foi atualizada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'BankAccount.id', 'hidden'); ?>

            <?php echo $this->App->createinput('Nome', 'BankAccount.name'); ?>

            <?php
                echo $this->App->createinput('', 'BankAccount.bank', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'BankAccountBank',
                    'autocomplete-source' => $this->App->createurl('/settings/system/banks_accounts/qbanks')
                ));

                echo $this->App->createinput('Banco', 'BankAccount.bank_name');
            ?>

            <?php echo $this->App->createinput('Agência', 'BankAccount.agency'); ?>
            <?php echo $this->App->createinput('Conta Corrente', 'BankAccount.account'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/settings/system/banks_accounts/update/' . $id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
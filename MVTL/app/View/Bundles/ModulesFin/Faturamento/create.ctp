<h2>Nova Nota Fiscal</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A nota fiscal foi cadastrada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('', 'ContractBilling.contract_id', 'hidden', $contract['Contract']['id']); ?>

            <?php echo $this->App->createinput('Número', 'ContractBilling.number'); ?>
            <?php
                $this->App->setattribute('input-mask', '99\/99\/9999');
                echo $this->App->createinput('Data', 'ContractBilling.date');
            ?>
            <?php echo $this->App->createinput('Valor', 'ContractBilling.value'); ?>

            <?php echo $this->App->createinput('Descritivo dos Serviços', 'ContractBilling.description', 'textarea'); ?>

            <?php
                $this->App->setattribute('options', array('Bahia' => 'Bahia', 'Sergipe' => 'Sergipe', 'Outro' => 'Outro'));
                echo $this->App->createinput('Estado', 'ContractBilling.state', 'radio');
            ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/fin/faturamento/create/' . $contract['Contract']['id']);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
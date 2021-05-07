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

            <h3>Contrato</h3>

            <?php $types = array('Êxito', 'Fixo', 'Fixo + êxito', 'Mensal', 'Mensal + êxito'); ?>

            <b>Número:</b> <?php echo $contract['Contract']['code_number'] . '/' . $contract['Contract']['code_year']; ?><br>
            <b>Tipo:</b> <?php echo $types[$contract['Contract']['type']]; ?><br>
            <b>Entidade:</b> <?php echo $contract['Entity']['name']; ?>

            <br><br><br><h3>Dados da Nota Fiscal</h3>

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
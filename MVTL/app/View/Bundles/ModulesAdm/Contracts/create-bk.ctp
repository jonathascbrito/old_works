<h2>Novo Contrato</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O contrato foi cadastrado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php echo $this->App->createinput('Objeto', 'Contract.object', 'textarea'); ?>

            <?php
                $this->App->setattribute('options', array('Êxito', 'Fixo', 'Fixo + êxito', 'Mensal', 'Mensal + êxito'));
                echo $this->App->createinput('Tipo', 'Contract.type', 'radio');
            ?>

            <?php
                echo $this->App->createinput('', 'Contract.entity_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'ContractEntityId',
                    'autocomplete-source' => $this->App->createurl('/modules/adm/contracts/qentities')
                ));

                echo $this->App->createinput('Entidade', 'Contract.entity_id_name');
            ?>

            <?php
                echo $this->App->createinput('', 'Contract.result_center_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'ContractResultCenterId',
                    'autocomplete-source' => $this->App->createurl('/modules/adm/contracts/qresultscenters')
                ));

                echo $this->App->createinput('Centro de Resultados', 'Contract.result_center_id_name');
            ?>

            <?php
                echo $this->App->createinput('', 'Contract.budget_account_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'ContractBudgetAccountId',
                    'autocomplete-source' => $this->App->createurl('/modules/adm/contracts/qbudgetsaccounts')
                ));

                echo $this->App->createinput('Conta Orçamentária', 'Contract.budget_account_id_name');
            ?>

            <?php
                $this->App->setattribute('input-mask', '99\/99');
                echo $this->App->createinput('Data Início', 'Contract.start');
            ?>

            <?php
                $this->App->setattribute('input-mask', '99\/99');
                echo $this->App->createinput('Data Fim', 'Contract.end');
            ?>

            <?php
                $this->App->setattribute('input-mask', '99\/99');
                echo $this->App->createinput('Data de Faturamento', 'Contract.bill_date');
            ?>

            <?php
                $this->App->setattribute('input-mask', '99\/99');
                echo $this->App->createinput('Data de Vencimento', 'Contract.pay_date');
            ?>

            <?php
                echo $this->App->createinput('Valor do Contrato', 'Contract.value');
            ?>

            <?php
                echo $this->App->createinput('Base do Êxito', 'Contract.exito_base');
            ?>

            <?php
                echo $this->App->createinput('Valor do Êxito', 'Contract.exito_value');
            ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/adm/contracts/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
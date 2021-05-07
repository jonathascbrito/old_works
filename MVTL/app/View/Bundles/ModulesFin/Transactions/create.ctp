<h2>Nova Movimentação</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A movimentação foi cadastrada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <h3>Movimentação</h3>

            <?php
                echo $this->App->createinput('Descrição', 'Transaction.description', 'textarea');
            ?>
            
            <?php
                $this->App->setattribute('options', array('Entrada', 'Saída'));
                echo $this->App->createinput('Tipo', 'Transaction.type', 'radio');
            ?>

            <?php
                echo $this->App->createinput('', 'Transaction.entity_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TransactionEntityId',
                    'autocomplete-source' => $this->App->createurl('/modules/fin/transactions/qentities')
                ));

                echo $this->App->createinput('Entidade', 'Transaction.entity_id_name');
            ?>

            <?php
                echo $this->App->createinput('', 'Transaction.budget_account_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TransactionBudgetAccountId',
                    'autocomplete-info' => "$('TransactionType0').get('checked') ? 'in' : 'out'",
                    'autocomplete-source' => $this->App->createurl('/modules/fin/transactions/qbudgetsaccounts')
                ));

                echo $this->App->createinput('Conta Orçamentária', 'Transaction.budget_account_id_name');
            ?>

            <?php
                $this->App->setattribute('input-mask', '99\/99\/9999');
                echo $this->App->createinput('Data de Competência', 'Transaction.bill_date');
            ?>

            <?php
                $this->App->setattribute('input-mask', '99\/99\/9999');
                echo $this->App->createinput('Data de Vencimento', 'Transaction.pay_date');
            ?>

            <?php
                echo $this->App->createinput('Valor da Movimentação', 'Transaction.value');
            ?>

            <br><br><h3>Rateio</h3>
            <div class="transaction-result-center">
            <?php
                echo $this->App->createinput('', 'Transaction.ResultsCenters.0.result_center_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TransactionResultsCenters0ResultCenterId',
                    'autocomplete-info' => "$('TransactionType0').get('checked') ? 'in' : 'out'",
                    'autocomplete-source' => $this->App->createurl('/modules/fin/transactions/qresultscenters')
                ));

                echo $this->App->createinput('Centro de Resultados', 'Transaction.ResultsCenters.0.result_center_id_name');

                $this->App->setattribute('onblur', 'checktransaction();');
                echo $this->App->createinput('Porcentagem', 'Transaction.ResultsCenters.0.part', 'text', '100');
            ?>
            </div>

            <?php for($i=1; $i<10; $i++) { ?>
            <div class="transaction-result-center hide">
            <div style="border-top: 1px solid #efefef; margin: 2px 5px;"></div>
            <?php
                echo $this->App->createinput('', 'Transaction.ResultsCenters.' . $i . '.result_center_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TransactionResultsCenters' . $i . 'ResultCenterId',
                    'autocomplete-source' => $this->App->createurl('/modules/fin/transactions/qresultscenters')
                ));

                echo $this->App->createinput('Centro de Resultados', 'Transaction.ResultsCenters.' . $i . '.result_center_id_name');

                $this->App->setattribute('onblur', 'checktransaction();');
                echo $this->App->createinput('Porcentagem', 'Transaction.ResultsCenters.' . $i . '.part');
            ?>
            </div>
            <?php } ?>

            <?php if($baixa) { ?>
                <br><br><h3>Baixa</h3>

                <?php
                    $this->App->setattribute('input-mask', '99\/99\/9999');
                    echo $this->App->createinput('Data de Baixa', 'Transaction.baixa_date');
                ?>

                <?php
                    echo $this->App->createinput('Valor', 'Transaction.baixa_value');
                ?>

                <?php
                echo $this->App->createinput('', 'Transaction.baixa_document_type_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'TransactionBaixaDocumentTypeId',
                    'autocomplete-source' => $this->App->createurl('/modules/fin/transactions/qdocuments')
                ));

                echo $this->App->createinput('Tipo Documento', 'Transaction.baixa_document_type_id_name');
                ?>
                
                <?php
                    echo $this->App->createinput('Número Documento', 'Transaction.baixa_document');
                ?>

                <?php
                    echo $this->App->createinput('', 'Transaction.bank_account_id', 'hidden');

                    $this->App->setattributes(array(
                        'autocomplete-for' => 'TransactionBankAccountId',
                        'autocomplete-source' => $this->App->createurl('/modules/fin/transactions/qbanksaccounts')
                    ));

                    echo $this->App->createinput('Conta Bancária', 'Transaction.bank_account_id_name');
                ?>
            <?php } ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/fin/transactions/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>

<script type="text/javascript">
    var checktransaction = function () {
        $$('.modal .transaction-result-center').each(function (obj) {
            var rs = obj.getElements('[name*=result_center_id]').get('value')[0];
            var part = obj.getElements('[name*=part]').get('value')[0];

            if (rs == '' && part == '') {
                obj.addClass('hide');
            }else{
                obj.removeClass('hide');
            }
        });

        var stop = false;
        $$('.modal .transaction-result-center').each(function (obj) {
            if ( ! stop) {
                if (obj.hasClass('hide')){
                    obj.removeClass('hide');
                    stop = true;
                }
            }
        });
    };
</script>
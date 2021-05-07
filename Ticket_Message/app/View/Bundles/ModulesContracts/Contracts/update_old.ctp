<h2>Adicionar Proposta</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A proposta <?php echo $this->request->data['Contract']['service']; ?> foi atualizada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php
                echo $this->App->createinput('', 'Contract.id', 'hidden');
            
                echo $this->App->createinput('', 'Contract.entity_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'ContractEntityId',
                    'autocomplete-source' => $this->App->createurl('/modules/contracts/qentities')
                ));

                echo $this->App->createinput('Cliente', 'Entity.name');
            ?>
            
            <?php echo $this->App->createinput('Serviço', 'Contract.service'); ?>
            
            <?php echo $this->App->createinput('Descrição do Serviço', 'Contract.description', 'textarea'); ?>
            
            <?php
                $this->App->setattribute('input-mask', '99\/99\/9999');
                echo $this->App->createinput('Data', 'Contract.date');
            ?>
            
            <?php
                $this->App->setattribute('options', array('0' => 'Em Análise', '1' => 'Aceita', '2' => 'Recusada'));
                echo $this->App->createinput('Tipo', 'Contract.situation', 'radio');
            ?>

            <?php echo $this->App->createattachment('Anexar um arquivo', 'Contract.Attachments'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/contracts/update/'.$id);
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
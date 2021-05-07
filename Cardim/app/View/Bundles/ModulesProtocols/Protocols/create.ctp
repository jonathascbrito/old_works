<h2>Novo Protocolo</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>O novo protocolo foi cadastrado com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php
                $this->App->setattribute('options', array('Interno' => 'Interno', 'Externo' => 'Externo'));
                echo $this->App->createinput('Tipo', 'Protocol.type', 'radio');
            ?>

            <?php
                $this->App->setattribute('options', array('Baixa', 'Normal', 'Urgente'));
                echo $this->App->createinput('Prioridade', 'Protocol.priority', 'radio');
            ?>

            <?php
                echo $this->App->createinput('', 'Protocol.from', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'ProtocolFrom',
                    'autocomplete-source' => $this->App->createurl('/modules/protocols/qusers')
                ));

                echo $this->App->createinput('Remetente', 'Protocol.from_name');
            ?>

            <?php
                echo $this->App->createinput('', 'Protocol.to', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'ProtocolTo',
                    'autocomplete-source' => $this->App->createurl('/modules/protocols/qusers')
                ));

                echo $this->App->createinput('Destinatário', 'Protocol.to_name');
            ?>

            <?php
                echo $this->App->createinput('', 'Protocol.logistic', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'ProtocolLogistic',
                    'autocomplete-source' => $this->App->createurl('/modules/protocols/qusers')
                ));

                echo $this->App->createinput('Logistica', 'Protocol.logistic_name');
            ?>

            <?php echo $this->App->createinput('Descrição do documento', 'Protocol.description', 'textarea'); ?>

            <?php echo $this->App->createattachment('Anexar um arquivo', 'Protocol.Attachments'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/protocols/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
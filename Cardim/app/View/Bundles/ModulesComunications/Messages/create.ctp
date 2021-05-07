<h2>Nova Mensagem</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>Sua mensagem para <?php echo $this->request->data['Message']['to_name']; ?> foi enviada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="create" method="post">

            <?php
                echo $this->App->createinput('', 'Message.to', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'MessageTo',
                    'autocomplete-source' => $this->App->createurl('/modules/messages/users')
                ));

                echo $this->App->createinput('Destinatário', 'Message.to_name');
            ?>

            <?php echo $this->App->createinput('Assunto', 'Message.subject'); ?>
            <?php echo $this->App->createinput('Mensagem', 'Message.content', 'textarea'); ?>

            <?php echo $this->App->createattachment('Anexar um arquivo', 'Message.Attachments'); ?>

            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'create');
                    echo $this->App->createmodalbutton('Enviar', 'open', '/modules/messages/create');
                ?>
            </div>

        </form>
    <?php endif; ?>
</div>
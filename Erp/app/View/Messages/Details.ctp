<h2><?php print $controller_name; ?> &rarr; <?php print $controller_action; ?></h2>

<div id="breadcrumb">

    <div id="links">
        <?php
        echo $this->Html->link("Ajuda", array(
            "controller" => "pages",
            "action" => "help"
                ), array(
            "class" => array(
                "help"
            )
                )
        );
        ?>
        <div class="sep"></div>
        <?php
        echo $this->Html->link("Configurações", array(
            "controller" => "pages",
            "action" => "settings"
                ), array(
            "class" => array(
                "settings"
            )
                )
        );
        ?>
    </div>

    <?php
    echo $this->Html->link("Home", array(
        "controller" => "pages",
        "action" => "home"
            ), array(
        "class" => array(
            "home"
        )
            )
    );
    ?>
    <div class="arrow"></div>
    <?php
    echo $this->Html->link("Mensagens", array(
        "controller" => "messages",
        "action" => "index"
            )
    );
    ?>
    <div class="arrow"></div>
    <?php
    echo $this->Html->link("Detalhes", array(
        "controller" => "messages",
        "action" => "view",
        $message['Message']['id']
            )
    );
    ?>
</div>



<div class="content">

    <?php echo $this->Session->flash(); ?>

    <?php
    echo $this->Form->create
            (
            "Message", array
        (
        "class" => "form-horizontal",
        "action" => "respond",
        "type" => "file",
            )
    );

    if (isset($id)) {
        echo $this->Form->input(
                "Message.id", array
            (
            "type" => "hidden",
            "value" => $id
                )
        );

        echo $this->Form->input(
                "Message.sender_id", array
            (
            "type" => "hidden",
            "value" => $message['Message']['sender_id']
                )
        );

        echo $this->Form->input(
                "Message.receiver_id", array
            (
            "type" => "hidden",
            "value" => $message['Message']['receiver_id']
                )
        );
    }
    ?>

    <fieldset>
        <legend>Informações da mensagem</legend>

        <div class="control-group">
            <label class="control-label" for="MessageSender">Remetente</label>

            <div class="controls">
                <div class="text"><?php print $message['Entity']['name']; ?></div>

            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="MessageReceiver">Destinatário</label>

            <div class="controls">
                <div class="text"><?php print $message['EntityReceiving']['name']; ?></div>

            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="MessageSubject">Assunto</label>

            <div class="controls">
                <div class="text"><?php print $message['Message']['subject']; ?></div>

            </div>
        </div>

<?php
foreach ($message['MessageContent'] as $messagecontent):

    ?>

            <div class="control-group">
                <label class="control-label" for="MessageContent">Enviada por <?php print $messagecontent['EntitySender']['name']; ?></label>

                <div class="controls">
                    <div class="text"><?php print $messagecontent['text_content']; ?></div>
                </div>
            </div>


            <?php if ( $messagecontent['attachment'] ) : ?>
            <div class="control-group">
                <label class="control-label" for=""></label>

                <div class="controls">
                    <div class="text">
                        <a href="<?php print $this->Html->url('/') . $messagecontent['attachment_path']; ?>" target="_blank"><?php print $messagecontent['attachment']; ?></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>


<?php endforeach; ?>
        <div class="control-group">
            <label class="control-label" for="MessageContentTextContent">Mensagem</label>

            <div class="controls">
<?php
echo $this->Form->input
        (
        "MessageContent.text_content", array
    (
    "div" => false,
    "label" => false,
    "type" => "textarea",
    "class" => "larger"
        )
);
?>

            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="MessageContentAttachment">Anexo</label>

            <div class="controls">
                <?php
                echo $this->Form->input
                        (
                        "MessageContent.attachment", array
                    (
                    "div" => false,
                    "label" => false,
                    "type" => "file"
                        )
                );
                ?>

            </div>
        </div>
    </fieldset>

                <?php

                ?>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Responder</button>
        <button type="button" class="btn">Cancelar</button>
    </div>
<?php echo $this->Form->end(); ?>

</div>
<?php
$this->start('script');
echo $this->Html->script('mvtl.protocol');
echo $this->Html->script('mvtl.form');

echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js');
$this->end();

$this->start('css');
echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/flick/jquery-ui.css', null, array('inline' => false));
$this->end();

echo $this->Html->scriptBlock('
  jQuery(function($){
    $("#destinatario").autocomplete({
      source: "' . $this->Html->url(array('action' => 'list_colaboradores')) . '"
    });


  });
', array('inline' => false));
?>

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
    echo $this->Html->link("Adicionar", array(
        "controller" => "messages",
        "action" => "add"
            )
    );
    ?>
</div>

<div class="description">
    Utilize está página para enviar uma nova mensagem interna.
</div>

<div class="content">

    <?php echo $this->Session->flash(); ?>

<?php
echo $this->Form->create
        (
        "Message", array
    (
    "type" => "file",
    "class" => "form-horizontal"
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
}
?>


    <fieldset>
        <legend>Dados da mensagem</legend>

        <div class="control-group">
            <label class="control-label" for="destinatario">Destinatário</label>

            <div class="controls">
    <?php
    echo $this->Form->input
            (
            "Message.receiver_name", array
        (
        "div" => false,
        "label" => false,
        "id" => 'destinatario'
            )
    );
    ?>

            </div>
        </div>


        <div class="control-group">
            <label class="control-label" for="MessageSubject">Assunto</label>

            <div class="controls inline-radio">


                <?php
                echo $this->Form->input
                        (
                        "Message.subject", array
                    (
                    "div" => false,
                    "label" => false,
                    "class" => array
                        (
                        "span5"
                    )
                        )
                );
                ?>



            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="MessageContent0TextContent">Mensagem</label>

            <div class="controls">
                <?php
                echo $this->Form->input
                        (
                        "MessageContent.0.text_content", array
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
            <label class="control-label" for="MessageContent0Attachment">Anexo</label>

            <div class="controls">
                <?php
                echo $this->Form->input
                        (
                        "MessageContent.0.attachment", array
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

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="button" class="btn">Cancelar</button>
    </div>

                <?php echo $this->Form->end(); ?>

</div>
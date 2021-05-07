<?php

$this->start( 'script' );
echo $this->Html->script( 'mvtl.protocol' );
echo $this->Html->script( 'mvtl.form');

echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js');
$this->end( );

$this->start( 'css' );
echo $this->Html->css('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/flick/jquery-ui.css', null, array('inline' => false));
$this->end();

echo $this->Html->scriptBlock('
  jQuery(function($){
    $("#destinatario").autocomplete({
      source: "' . $this->Html->url(array('action' => 'list_names')) . '"
    });

    $("#logistica").autocomplete({
        source: "'. $this->Html->url(array('action' => 'list_colaboradores')) . '"
    });
  });
', array('inline' => false));

?>

<h2><?php print $controller_name; ?> &rarr; <?php print $controller_action; ?></h2>

<div id="breadcrumb">

    <div id="links">
         <?php
            echo $this->Html->link( "Ajuda",
                array(
                    "controller"    => "pages",
                    "action"        => "help"
                ),
                array(
                    "class"         => array(
                        "help"
                    )
                )
            );
        ?>
        <div class="sep"></div>
        <?php echo $this->element( 'settings-link' ); ?>
    </div>

    <?php
        echo $this->Html->link( "Home",
            array(
                "controller"    => "pages",
                "action"        => "home"
            ),
            array(
                "class"         => array(
                    "home"
                )
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Protocolos",
            array(
                "controller"    => "protocols",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "protocols",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para adicionar um novo protocolo ao sistema. Protocolos são usados para identificar a localozação de um documento em circulação.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Protocol",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Protocol.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>


<fieldset>
<legend>Dados do Protocolo</legend>

<div class="control-group">
    <label class="control-label" for="ProtocolType">Tipo</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Protocol.type",
                array
                (
                    "div" => false,
                    "label" => false,
                    "options" => array
                    (
                        ""         => "Selecione um tipo...",
                        "Externo"  => "Externo",
                        "Interno"=> "Interno"
                    )
                )
            );
        ?>

        <span class="help-block">Tipo da tramitação do documento.</span>
    </div>
</div>


</fieldset>

<fieldset>
<legend>Informações do Protocolo</legend>

<div class="control-group">
    <label class="control-label" for="ProtocolPriority">Prioridade</label>

    <div class="controls inline-radio">


            <?php
                echo $this->Form->input
                (
                    "Protocol.priority",
                    array
                    (
                        "div" => false,
                        "legend" => false,
                        "type" => "radio",
                        "label" => true,
                        "separator" => '<span class="sep"></span>',
                        "options" => array("B" => "Baixo", "N" => "Normal", "U" => "Urgente")
                    )
                );
            ?>


        <span class="help-block">Prioridade da tramitação do documento.</span>
    </div>
</div>

<div class="interno" style="display: none;">
    <div class="control-group">
    <label class="control-label" for="ProtocolOrganizationalUnitIdReceiving">Destino</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Protocol.organizational_unit_id_receiving",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "select",
                    "options" => $departments,
                    "class" => array
                    (
                        "span5"
                    )
                )
            );
        ?>

        <span class="help-block">Empresa/Setor de destino da solicitação.</span>
    </div>
</div>



</div>

<div class="externo" style="display: none;">


<div class="control-group">
    <label class="control-label" for="ProtocolResponseReceivingName">Destinatário</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Protocol.response_receiving_name",
                array
                (
                    "div" => false,
                    "label" => false,
                    "id"    => 'destinatario'
                )
            );
        ?>

        <span class="help-block">Para quem será enviado o documento.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ProtocolLogisticResponseNome">Responsável pela logística</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Protocol.logistic_response_nome",
                array
                (
                    "div" => false,
                    "label" => false,
                    "id"    => 'logistica'
                )
            );
        ?>

        <span class="help-block">Encarregado de despachar o documento.</span>
    </div>
</div>


</div>

<div class="control-group">
    <label class="control-label" for="ProtocolDescription">Descrição</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Protocol.description",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "textarea",
                    "class" => "larger"
                )
            );
        ?>

        <span class="help-block">Empresa/Setor de destino da soliciitação do protocolo.</span>
    </div>
</div>

</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
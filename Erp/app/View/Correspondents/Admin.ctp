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
        <?php
            echo $this->Html->link( "Configurações",
                array(
                    "controller"    => "pages",
                    "action"        => "settings"
                ),
                array(
                    "class"         => array(
                        "settings"
                    )
                )
            );
        ?>
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
        echo $this->Html->link( "Correspondentes",
            array(
                "controller"    => "correspondents",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "correspondents",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para adicionar um novo registro de processos tratados com correspondentes.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Correspondent",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Correspondent.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>


<fieldset>
<legend>Informações do Ato</legend>

<div class="control-group">
    <label class="control-label" for="CorrespondentDateAudience">Data da Audiência</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.date_audience",
                array
                (
                    "div" => false,
                    "label" => false,
                    'type' => 'date',
                    "class" => "span1"
                )
            );
        ?>

        <span class="help-block">Informe a data do Ato.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentProcessNumber">Número do processo</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.process_number",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Número do processo do ato.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentClientId">Cliente</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.client_id",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o cliente da ação.</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="CorrespondentAdverseParty">Parte Adversa</label>
    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.adverse_party",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>
        <span class="help-block">Nome da parte adversa da ação.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentRealizedAct">Ato realizado</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.realized_act",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>
        <span class="help-block">Informe qual foi o ato a ser realizado.</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="CorrespondentJudicialDistrictAct">Comarca da realização do Ato</label>
    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.judicial_district_act",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>
        <span class="help-block">Local onde será realizado o ato.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentJudicialDistrictOrigin">Comarca de origem do Ato</label>
    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.judicial_district_origin",
                array
                (
                    "div" => false,
                    "label" => false,
                    "id"    => 'comarca_origem'
                )
            );
        ?>

        <span class="help-block">Local origem do ato.</span>
    </div>
</div>


</fieldset>



<fieldset>
    <legend>Informações do Representante</legend>


    <div class="control-group">
        <label class="control-label" for="CorrespondentCorrespondent_id">Nome do Escritório</label>

        <div class="controls">
            <?php
                echo $this->Form->input
                (
                    "Correspondent.correspondent_id",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type"  => "text"
                    )
                );
            ?>

            <span class="help-block">Nome do escritório responsável pelar realização do ato.</span>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="CorrespondentObservation">Observações internas</label>

        <div class="controls">
            <?php
                echo $this->Form->input
                (
                    "Correspondent.observation",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type"  => "textarea",
                        "class" => "larger"
                    )
                );
            ?>

            <span class="help-block">Observações referentes ao Ato.</span>
        </div>
    </div>

</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
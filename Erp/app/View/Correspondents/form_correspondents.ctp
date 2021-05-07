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
        echo $this->Html->link( "Representação",
            array(
                "controller"    => "correspondents",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Retorno",
            array(
                "controller"    => "correspondentes",
                "action"        => "return"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para informar resultado referente ao processo tratado por seu escritório.
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
<legend>Informações do Ato.</legend>



    <div class="control-group">
        <label class="control-label" for="TicketEntityId">Nome</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Entity']['name']; ?></div>
        </div>
    </div>

<div class="control-group">
    <label class="control-label" for="CorrespondentDate">Data</label>

        <div class="controls">
            <div class="text"><?php print $correspondent['Correspondent']['date']; ?></div>
        </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentRealizedAct">Ato que sera realizado</label>

        <div class="controls">
            <div class="text"><?php print $correspondent['Correspondent']['realized_act']; ?></div>
        </div>
</div>


<div class="control-group">
    <label class="control-label" for="CorrespondentClienteId">Cliente</label>

        <div class="controls">
            <div class="text"><?php print $correspondent['Entity']['client_id']; ?></div>
        </div>
</div>



<div class="control-group">
    <label class="control-label" for="CorrespondentParteAdversa">Parte Adversa</label>


        <div class="controls">
            <div class="text"><?php print $correspondent['Correspondent']['adverse_party']; ?></div>
        </div>
</div>


<div class="control-group">
    <label class="control-label" for="CorrespondentNumeroProcesso">Número do processo</label>

        <div class="controls">
            <div class="text"><?php print $correspondent['Correspondent']['process_number']; ?></div>
        </div>
</div>




<div class="control-group">
    <label class="control-label" for="CorrespondentComarcaRealizacao">Comarca da realização do Ato</label>

        <div class="controls">
            <div class="text"><?php print $correspondent['Correspondent']['judicial_district_act']; ?></div>
        </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentComarcaOrigem">Comarca de origem do Ato</label>

        <div class="controls">
            <div class="text"><?php print $correspondent['Correspondent']['judicial_district_origin']; ?></div>
        </div>
</div>



</fieldset>
    
<fieldset>

    <legend>Informações sobre o retorno da Ação</legend>
    
    
    <div class="control-group">
        <label class="control-label" for="CorrespondentDeslocamento">Deslocamento</label>

        <div class="controls">
            <?php
                echo $this->Form->input
                (
                    "Correspondent.deslocamento",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type"  => "text"
                    )
                );
            ?>

            <span class="help-block">Distância (em quilômetros) gasta com deslocamento para realização do ato.</span>
        </div>
    </div>

<div class="control-group">
    <label class="control-label" for="CorrespondentValorHonorarios">Honorários</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.valor_honorarios",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "text"
                )
            );
        ?>

        <span class="help-block">Valor gasto com honorários.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentPreposto">Preposto</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.preposto",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "text"
                )
            );
        ?>

        <span class="help-block">Valor gasto Preposto.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentObservacoes">Observações internas</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.observacoes",
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
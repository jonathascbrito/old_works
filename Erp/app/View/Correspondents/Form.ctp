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
                "controller"    => "correspondentes",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para adicionar um novo registro de novos processos tratados com correspondentes.
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
    <label class="control-label" for="CorrespondentDate">Data</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.date",
                array
                (
                    "div" => false,
                    "label" => false,
                    "class" => "span2"
                )
            );
        ?>

        <span class="help-block">Informe a data da ação.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentAtoRealizado">Ato que sera realizado</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.ato_realizado",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe a data da ação.</span>
    </div>
</div>


<div class="control-group">
    <label class="control-label" for="CorrespondentClienteId">Cliente</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.cliente_id",
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
    <label class="control-label" for="CorrespondentParteAdversa">Parte Adversa</label>


<div class="controls">

            <?php
                echo $this->Form->input
                (
                    "Correspondent.parte_adversa",
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
    <label class="control-label" for="CorrespondentNumeroProcesso">Número do processo</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.numero_processo",
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
    <label class="control-label" for="CorrespondentComarcaRealizacao">Comarca da realização do Ato</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.comarca_realizacao",
                array
                (
                    "div" => false,
                    "label" => false,
                    "id"    => 'comarca_realizacao'
                )
            );
        ?>

        <span class="help-block">Local onde será realizado o ato.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="CorrespondentComarcaOrigem">Comarca de origem do Ato</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.comarca_origem",
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


<div class="control-group">
    <label class="control-label" for="CorrespondentEscritorioId">Nome do Escritório</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Correspondent.escritorio_id",
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

        <span class="help-block">Observações referentes ao Ato..</span>
    </div>
</div>

</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
<?php

$this->start( 'script' );
echo $this->Html->script( 'mvtl.form' );
$this->end( );

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
                    "controller"    => "settings",
                    "action"        => "index"
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
        echo $this->Html->link( "Cadastro de Problemas",
            array(
                "controller"    => "problems",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "problems",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para cadastrar ou editar tipos de dificuldades para o Ticket.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Tax",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Tax.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
    <legend>Dados do Problema</legend>

<div class="control-group">
    <label class="control-label" for="ProblemProblem">Tipo de Problema</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Problem.problem",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ProblemDescription">Descrição do Problema</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Problem.description",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "textarea"
                )
            );
        ?>

        <span class="help-block">Realize uma breve descrição sobre a dificuldade</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="ProblemPrevision">Previsão para resolução</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Problem.prevision",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o prazo para que seja sanada a dificuldade</span>
    </div>
</div>


</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
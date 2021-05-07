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

        <?php print $this->element('settings-link'); ?>
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
        echo $this->Html->link( "Usuários",
            array(
                "controller"    => "users",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "users",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para cadastrar ou editar os usuários do sistema.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "User",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "User.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
    <legend>Dados do Usuário</legend>

<div class="control-group">
    <label class="control-label" for="UserEntityId">Entidade</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "User.entity_id",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe a entidade relacionada ao usuário</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="UserUsername">Usuário</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "User.username",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o nome do usuário</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="UserPassword">Senha</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "User.password",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type" => "password"
                )
            );
        ?>

        <span class="help-block">Informe a senha do usuário</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="UserRoleId">Perfil</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "User.role_id",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o perfil de acesso do usuário</span>
    </div>
</div>

</fieldset>



<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>
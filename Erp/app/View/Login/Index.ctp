<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "login",
        array
        (
            "class" => "form-horizontal"
        )
    );
?>

<?php
    echo $this->Form->input
    (
        "login.username",
        array
        (
            "div" => false,
            "label" => false,
            "type" => 'text',
            "class" => array
            (
                "span1"
            )
        )
    );
?>

<?php
    echo $this->Form->input
    (
        "login.password",
        array
        (
            "div" => false,
            "label" => false,
            "type" => 'password',
            "class" => array
            (
                "span1"
            )
        )
    );
?>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>
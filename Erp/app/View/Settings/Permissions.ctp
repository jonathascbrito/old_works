<?php

$this->start( 'script' );
echo $this->Html->script( 'mvtl.form' );
echo $this->Html->script( 'mvtl.settings.permissions' );
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
        echo $this->Html->link( "Configurações",
            array(
                "controller"    => "settings",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Permissões",
            array(
                "controller"    => "settings",
                "action"        => "permissions"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta área para definir as permissões de cada perfil do sistema. O formulário abaixo não
    possui botões para salvar ou cancelar. As alteração realizadas são salvas automaticamente.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    if ( count($roles) == 0 ) :

        ?>
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert">×</a>
            Para definir permissões você deve criar pelo menos 1 perfil!
        </div>
        <?php

    else:

    echo $this->Form->create
    (
        "Permission",
        array
        (
            "class" => "form-horizontal"
        )
    );

    ?>
        <table class="table table-striped">
    <?php

    $group = '';
    foreach ( $permissions as $permission ) :

        if ( $group != $permission[ 'Permission' ][ 'group' ] ) :
            $group = $permission[ 'Permission' ][ 'group' ];

            ?>

            <thead>
                <tr>
                    <th colspan="1"><?php print h($group); ?></th>
                    <th colspan="3" class="align-right no-bold">
                        <a class="description-toggle" href="#">Mostrar/Esconder Descrições</a>
                    </th>
                </tr>
                <tr>
                    <th>Permissão</th>
                    <?php foreach ( $roles as $role ) : ?>
                        <th class="align-center"><?php print $role['Role']['name']; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>

            <tbody>

            <?php

        endif;

        ?>

            <tr>
                <td>
                    <?php print h($permission[ 'Permission' ][ 'name' ]); ?>

                    <span class="help-block no-margin">
                        <?php print h($permission[ 'Permission' ][ 'description' ]); ?>
                    </span>
                </td>

                <?php foreach ( $roles as $role ) : ?>

                    <td class="align-center">
                        <?php
                            echo $this->Form->input
                            (
                                "permissions[" . $permission['Permission']['id'] . "][]",
                                array
                                (
                                    "div" => false,
                                    "label" => false,
                                    "type" => "checkbox",
                                    "value" => $role['Role']['id']
                                )
                            );
                        ?>
                    </td>

                <?php endforeach; ?>
            </tr>

        <?php

    endforeach;

    ?>
            </tbody>
        </table>
    <?php

    echo $this->Form->end( );

    endif;
?>

</div>
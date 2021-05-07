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
        echo $this->Html->link( "Listar",
            array(
                "controller"    => "users",
                "action"        => "index"
            )
        );
    ?>
</div>

<div class="description">
    Esta página lista os usuários cadastrados.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<div class="align-left">
    <a href="#" class="filter-toggle"><i class="icon-search"></i> Filtrar</a>
</div>

<?php

    echo $this->Form->create(
        "filter",
        array
        (
            "class" => array
            (
                "filter-form",
                "form-horizontal"
            )
        )
    );
?>
    <div class="align-left">
        <div class="input-append">
            <?php
                echo $this->Form->input( "terms", array
                    (
                        "div" => false,
                        "label" => false,
                        "type"  => "text",
                        "class" => array
                        (
                            "span5"
                        )
                    )
                );
            ?>
            <input class="btn" type="submit" value="filtrar">
        </div>
    </div>
<?php

    echo $this->Form->end( );

?>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('User.username', 'Usuário'); ?></th>
            <th>Perfil</th>
            <th>Entidade</th>
            <th>
                <?php
                    echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                        array(
                            "controller"    => "users",
                            "action"        => "add"
                        ),
                        array(
                            'escape'        => false,
                            'rel'           => 'tooltip',
                            'title'         => 'Adicionar Usuário'
                        )
                    );
                ?>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php
                        if ( $terms ) :
                            $user['User']['username'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $user['User']['username']
                                );
                        endif;

                        echo $user['User']['username'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $user['Role']['name'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $user['Entity']['name'];
                    ?>
                </td>

                <td>
                    <?php
                        echo $this->Html->link( '<i class="icon-edit"></i>',
                            array(
                                "controller"    => "users",
                                "action"        => "edit",
                                $user['User']['id']
                            ),
                            array(
                                'escape'        => false,
                                'rel'           => 'tooltip',
                                'title'         => 'Editar Usuário'
                            )
                        );
                    ?>

                    <?php
                        echo $this->Html->link( '<i class="icon-remove"></i>',
                            array(
                                "controller"    => "users",
                                "action"        => "delete",
                                $user['User']['id']
                            ),
                            array(
                                'escape'        => false,
                                'rel'           => 'tooltip',
                                'title'         => 'Remover Usuário'
                            )
                        );
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination pagination-right">

    <div class="info">
        <?php
            echo $this->Paginator->counter
            (
                'Página {:page} de {:pages} - mostrando {:current} itens de {:count}'
            );
        ?>
    </div>

    <ul>
        <?php
            echo $this->Paginator->prev
            (
                '« Anterior',
                array
                (
                    'tag'   => 'li'
                ),
                null,
                array
                (
                    'tag'   => 'li',
                    'class' => 'disabled'
                )
            );
            print $this->Paginator->numbers(array
                (
                    'separator'     => false,
                    'tag'           => 'li',
                    'currentClass'  => 'active'
                )
            );
            echo $this->Paginator->next
            (
                'Próximo »',
                array
                (
                    'tag'   => 'li'
                ),
                null,
                array
                (
                    'tag'   => 'li',
                    'class' => 'disabled'
                )
            );
        ?>
    </ul>
</div>

</div>
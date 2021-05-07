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
        echo $this->Html->link( "Problem",
            array(
                "controller"    => "problems",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Listar",
            array(
                "controller"    => "problems",
                "action"        => "index"
            )
        );
    ?>
</div>

<div class="description">
    Está página lista os tipos de dificuldades que podem ser vistas na abertura do ticket
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
            <th><?php echo $this->Paginator->sort('Problem.problem', 'Tipo de Problema'); ?></th>
            <th><?php echo $this->Paginator->sort('Problem.prevision', 'Previsão para resolução'); ?></th>
            <th><?php echo $this->Paginator->sort('Problem.description', 'Descrição'); ?></th>
            <th>
                <?php
                    echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                        array(
                            "controller"    => "problems",
                            "action"        => "add"
                        ),
                        array(
                            'escape'        => false,
                            'rel'           => 'tooltip',
                            'title'         => 'Cadastrar novo tipo de problema'
                        )
                    );
                ?>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($problems as $problem): ?>
            <tr>
                <td>
                    <?php
                        if ( $terms ) :
                            $problem['Problem']['problem'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $problem['Problem']['problem']
                                );
                        endif;

                        echo $problem['Problem']['problem'];
                    ?>
                </td>
                <td>
                    <?php
                        if ( $terms ) :
                            $problem['Problem']['prevision'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $problem['Problem']['prevision']
                                );
                        endif;

                        echo $problem['Problem']['prevision'];
                    ?>
                </td>
                <td>
                    <?php
                        if ( $terms ) :
                            $problem['Problem']['description'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $problem['Problem']['description']
                                );
                        endif;

                        echo $problem['Problem']['description'];
                    ?>
                </td>


                <td>
                    <?php
                        echo $this->Html->link( '<i class="icon-edit"></i>',
                            array(
                                "controller"    => "problems",
                                "action"        => "edit",
                                $problem['Problem']['id']
                            ),
                            array(
                                'escape'        => false,
                                'rel'           => 'tooltip',
                                'title'         => 'Editar Problema'
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
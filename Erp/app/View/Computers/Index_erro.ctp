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
        echo $this->Html->link( "Computers",
            array(
                "controller"    => "computers",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Listar",
            array(
                "controller"    => "computers",
                "action"        => "index"
            )
        );
    ?>
</div>

<div class="description">
    Esta página lista os computadores cadastrados para MVTL
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
            <th><?php echo $this->Paginator->sort('Computer.code', 'Código'); ?></th>
            <th><?php echo $this->Paginator->sort('Computer.nome', 'Nome'); ?></th>
            <th>
                <?php
                    echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                        array(
                            "controller"    => "computers",
                            "action"        => "add"
                        ),
                        array(
                            'escape'        => false,
                            'rel'           => 'tooltip',
                            'title'         => 'Cadastrar novo computador'
                        )
                    );
                ?>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($computers as $computer): ?>
            <tr>
                <td>
                    <?php
                        if ( $terms ) :
                            $computer['Computer']['code'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $computer['Computer']['code']
                                );
                        endif;

                        echo $computer['Computer']['code'];
                    ?>
                </td>
                <td>
                    <?php
                        if ( $terms ) :
                            $computer['Computer']['name'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $computer['Computer']['name']
                                );
                        endif;

                        echo $computer['Computer']['name'];
                    ?>
                </td>


                <td>
                    <?php
                        echo $this->Html->link( '<i class="icon-edit"></i>',
                            array(
                                "controller"    => "computers",
                                "action"        => "edit",
                                $computer['Computer']['id']
                            ),
                            array(
                                'escape'        => false,
                                'rel'           => 'tooltip',
                                'title'         => 'Editar Cadastro do PC'
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
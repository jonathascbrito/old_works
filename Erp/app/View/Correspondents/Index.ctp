<h2><?php print $controller_name; ?> &rarr; <?php print $controller_action; ?></h2>

<div id="breadcrumb">

    <div id="links">
        <?php
        echo $this->Html->link("Ajuda", array(
            "controller" => "pages",
            "action" => "help"
                ), array(
            "class" => array(
                "help"
            )
                )
        );
        ?>
        <div class="sep"></div>
        <?php
        echo $this->Html->link("Configurações", array(
            "controller" => "pages",
            "action" => "settings"
                ), array(
            "class" => array(
                "settings"
            )
                )
        );
        ?>
    </div>

    <?php
    echo $this->Html->link("Home", array(
        "controller" => "pages",
        "action" => "home"
            ), array(
        "class" => array(
            "home"
        )
            )
    );
    ?>
    <div class="arrow"></div>
    <?php
    echo $this->Html->link("Correspondentes", array(
        "controller" => "correspondents",
        "action" => "index"
            )
    );
    ?>
    <div class="arrow"></div>
    <?php
    echo $this->Html->link("Listar", array(
        "controller" => "correspondents",
        "action" => "index"
            )
    );
    ?>
</div>

<div class="description">
    Lista de representantes.
</div>
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


<div class="content">

    <?php echo $this->Session->flash(); ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('Correspondent.process_number', 'Nº Processo'); ?></th>
                <th><?php echo $this->Paginator->sort('Correspondent.cliente_id', 'Cliente'); ?></th>
                <th><?php echo $this->Paginator->sort('Correspondent.correspondent_id', 'Escritório'); ?></th>
                <th><?php echo $this->Paginator->sort('Correspondent.realized_act', 'Ato Realizado'); ?></th>
                <th><?php echo $this->Paginator->sort('Correspondent.date', 'Data'); ?></th>

                <th>
                    <?php
                    echo $this->Html->link('<i class="icon-plus-sign"></i>', array(
                        "controller" => "correspondents",
                        "action" => "admin"
                            ), array(
                        'escape' => false,
                        'rel' => 'tooltip',
                        'title' => 'Inserir novo.'
                            )
                    );
                    ?>
                </th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($correspondents as $correspondent): ?>

                <tr>
                    <td><?php

                            if ( $terms ) :
                            $correspondent['Correspondent']['process_number'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $correspondent['Correspondent']['process_number']
                                );
                        endif;

                            echo $correspondent['Correspondent']['process_number']; ?>
                    </td>

                    <td>
                        <?php

                        if ( $terms ) :
                            $correspondent['EntityClient']['name'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $correspondent['Entity']['name']
                                );
                        endif;

                        echo $correspondent['Entity']['name']; ?>
                    </td>

                    <td><?php

                        if ( $terms ) :
                            $correspondent['Entity']['name'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $correspondent['Entity']['name']
                                );
                        endif;

                        $correspondent['Entity']['name']; ?>
                    </td>

                    <td><?php
                        if ( $terms ) :
                            $correspondent['Correspondent']['realized_act'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $correspondent['Correspondent']['realized_act']
                                );
                        endif;

                        echo $correspondent['Correspondent']['realized_act'];

                         ?>
                    </td>

                    <td><?php

                        if ( $terms ) :
                            $correspondent['Correspondent']['date'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $correspondent['Correspondent']['date']
                                );
                        endif;

                        echo $correspondent['Correspondent']['date'];

                         ?>
                    </td>

                    <td>
                        <?php

                            echo $this->Html->link('<i class="icon-zoom-in"></i>', array(
                                "controller" => "messages",
                                "action" => "view",
                                $correspondent['Correspondent']['id']
                                    ), array(
                                'escape' => false,
                                'rel' => 'tooltip',
                                'title' => 'Detalhes.'
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
                    '« Anterior', array
                (
                'tag' => 'li'
                    ), null, array
                (
                'tag' => 'li',
                'class' => 'disabled'
                    )
            );
            print $this->Paginator->numbers(array
                        (
                        'separator' => false,
                        'tag' => 'li',
                        'currentClass' => 'active'
                            )
                    );
            echo $this->Paginator->next
                    (
                    'Próximo »', array
                (
                'tag' => 'li'
                    ), null, array
                (
                'tag' => 'li',
                'class' => 'disabled'
                    )
            );
            ?>
        </ul>
    </div>

</div>
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
    echo $this->Html->link("Mensagens", array(
        "controller" => "messages",
        "action" => "index"
            )
    );
    ?>
    <div class="arrow"></div>
    <?php
    echo $this->Html->link("Listar", array(
        "controller" => "messages",
        "action" => "index"
            )
    );
    ?>
</div>

<div class="description">
    Lista das mensagens enviadas/recebidas.
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
<div class="btn-group">
        <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
            Opções de listagem
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li style="font-size: 12px;"><?php
                    echo $this->Html->link('Novas Mensagens', array(
                        "controller" => "messages",
                        "action" => "index_novas"
                            )
                    );
                    ?></li>
            <li style="font-size: 12px;"><?php
                    echo $this->Html->link('Todos', array(
                        "controller" => "messages",
                        "action" => "index"
                            )
                    );
                    ?></li>
        </ul>
    </div>
    <br/>
    <?php echo $this->Session->flash();
     ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('Message.sender_id', 'Remetente'); ?></th>
                <th><?php echo $this->Paginator->sort('Message.receiver_id', 'Destinatário'); ?></th>
                <th><?php echo $this->Paginator->sort('Message.subject', 'Assunto'); ?></th>
                <th><?php echo 'Status'; ?></th>

                <th>
                    <?php
                    echo $this->Html->link('<i class="icon-plus-sign"></i>', array(
                        "controller" => "messages",
                        "action" => "add"
                            ), array(
                        'escape' => false,
                        'rel' => 'tooltip',
                        'title' => 'Enviar Mensagem'
                            )
                    );
                    ?>
                </th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($messages as $message): ?>

                <tr>
                    <td><?php

                            if ( $terms ) :
                            $message['Entity']['name'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $message['Entity']['name']
                                );
                        endif;

                            echo $message['Entity']['name']; ?>
                    </td>

                    <td>
                        <?php

                        if ( $terms ) :
                            $message['EntityReceiving']['name'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $message['EntityReceiving']['name']
                                );
                        endif;

                        echo $message['EntityReceiving']['name']; ?>
                    </td>

                    <td><?php

                        if ( $terms ) :
                            $message['Message']['subject'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $message['Message']['subject']
                                );
                        endif;

                        echo $message['Message']['subject']; ?>
                    </td>

                    <td><?php if($message['Entity']['id'] == 1) {

                        if ( $terms ) :
                            $message['Message']['sender_status'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $message['Message']['sender_status']
                                );
                        endif;

                        echo $message['Message']['sender_status'];

                    } else if ($message['EntityReceiving']['id'] == 1) {

                        if ( $terms ) :
                            $message['Message']['receiver_status'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $message['Message']['receiver_status']
                                );
                        endif;

                        echo $message['Message']['receiver_status'];
                    }

                         ?>
                    </td>

                    <td>
                        <?php



                            echo $this->Html->link('<i class="icon-comment"></i>', array(
                                "controller" => "messages",
                                "action" => "view",
                                $message['Message']['id']
                                    ), array(
                                'escape' => false,
                                'rel' => 'tooltip',
                                'title' => 'Detalhes da mensagem enviada.'
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
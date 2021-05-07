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
    echo $this->Html->link("Protocolos", array(
        "controller" => "protocols",
        "action" => "index"
            )
    );
    ?>
    <div class="arrow"></div>
    <?php
    echo $this->Html->link("Listar", array(
        "controller" => "protocols",
        "action" => "index"
            )
    );
    ?>
</div>

<div class="description">
    Lista com todos os contratos do escritório. Contratos são utilizados para facilitar os processos de feturamento e cobrança do escritóio.
</div>


<div class="content">

    <div class="btn-group">
        <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
            Opções de listagem
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li style="font-size: 12px;"><?php
                    echo $this->Html->link('Enviados', array(
                        "controller" => "protocols",
                        "action" => "index_enviados"
                            )
                    );
                    ?></li>
            <li style="font-size: 12px;"><?php
                    echo $this->Html->link('Recebidos', array(
                        "controller" => "protocols",
                        "action" => "index_recebidos"
                            )
                    );
                    ?></li>
            <li style="font-size: 12px;"><?php
                    echo $this->Html->link('Todos', array(
                        "controller" => "protocols",
                        "action" => "index"
                            )
                    );
                    ?></li>
        </ul>
    </div>
    <br/>
    <?php echo $this->Session->flash(); ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('number', 'Nº'); ?></th>
                <th><?php echo $this->Paginator->sort('OrganizationalUnit.name', 'Origem'); ?></th>
                <th><?php echo $this->Paginator->sort('type', 'Tipo'); ?></th>
                <th><?php echo $this->Paginator->sort('create_data', 'Criação'); ?></th>
                <th>Destino</th>
                <th>Status</th>
                <th>
                    <?php
                    echo $this->Html->link('<i class="icon-plus-sign"></i>', array(
                        "controller" => "protocols",
                        "action" => "add"
                            ), array(
                        'escape' => false,
                        'rel' => 'tooltip',
                        'title' => 'Adicionar Protocolo'
                            )
                    );
                    ?>
                </th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($protocols as $protocol): ?>
                <tr>
                    <td><?php echo $protocol['Protocol']['number']; ?> </td>
                    <?php  //@TODO: OrganizationalUnit ?>
                    <td><?php echo h($protocol['OrganizationalUnit']['name']); ?> </td>
                    <td><?php echo h($protocol['Protocol']['type']); ?> </td>
                    <td><?php echo h($protocol['Protocol']['create_date_formated']); ?> </td>
                    <td><?php echo ($protocol['Protocol']['type'] == "Interno" ? h($protocol['OrganizationalUnit']['name']) : h($protocol['Protocol']['response_receiving_name']) ); ?> </td>
                    <td><?php echo h($protocol['Protocol']['status']); ?> </td>
                    <td>
                        <?php
                        $user = $this->Session->read('User');

                        if ($protocol['Protocol']['entity_id'] == $user['Entity']['id'] && $protocol['Protocol']['status'] != "Finalizar") {

                            echo $this->Html->link('<i class="icon-zoom-in"></i>', array(
                                "controller" => "protocols",
                                "action" => "view",
                                $protocol['Protocol']['id']
                                    ), array(
                                'escape' => false,
                                'rel' => 'tooltip',
                                'title' => 'Detalhes do Protocolo'
                                    )
                            );
                        } else if ($protocol['Protocol']['entity_id'] == $user['Entity']['id'] && $protocol['Protocol']['status'] == "Finalizar") {
                            echo $this->Html->link('<i class="icon-edit"></i>', array(
                                "controler" => "protocols",
                                "action" => "edit_finaliza",
                                $protocol['Protocol']['id']
                                    ), array(
                                'escape' => false,
                                'rel' => 'tooltip',
                                'title' => 'Finaliza o protocolo.'
                                    )
                            );
                        } else if($protocol['Protocol']['response_receiving_id'] == $user['Entity']['id'] && $protocol['Protocol']['status'] == "Aberto") {
                            echo $this->Html->link('<i class="icon-edit"></i>', array(
                                "controler" => "protocols",
                                "action" => "edit_receiving",
                                $protocol['Protocol']['id']
                                    ), array(
                                'escape' => false,
                                'rel' => 'tooltip',
                                'title' => 'Informa recebimento do protocolo.'
                                    )
                            );
                        } else if ($protocol['Protocol']['response_receiving_id'] == $user['Entity']['id'] && $protocol['Protocol']['status'] == "Em Andamento") {
                           echo $this->Html->link('<i class="icon-edit"></i>', array(
                                "controler" => "protocols",
                                "action" => "complete_receiving",
                                $protocol['Protocol']['id']
                                    ), array(
                                'escape' => false,
                                'rel' => 'tooltip',
                                'title' => 'Informa realização da solicitação.'
                                    )
                            );
                        } else if ($protocol['Protocol']['response_receiving_id'] == $user['Entity']['id'] && $protocol['Protocol']['status'] == "Finalizar") {
                             echo $this->Html->link('<i class="icon-zoom-in"></i>', array(
                                "controller" => "protocols",
                                "action" => "view",
                                $protocol['Protocol']['id']
                                    ), array(
                                'escape' => false,
                                'rel' => 'tooltip',
                                'title' => 'Detalhes do Protocolo'
                                    )
                            );
                        }
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
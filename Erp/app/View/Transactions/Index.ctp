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
        echo $this->Html->link( "Movimentações",
            array(
                "controller"    => "transactions",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Listar",
            array(
                "controller"    => "transactions",
                "action"        => "index"
            )
        );
    ?>
</div>

<div class="description">
    Lista todas as movimentações do escritório, ordenadas pela data de vencimento.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
            <th><?php echo $this->Paginator->sort('Entity.name', 'Entidade'); ?></th>
            <th><?php echo $this->Paginator->sort('type', 'Tipo'); ?></th>
            <th><?php echo $this->Paginator->sort('value', 'Valor'); ?></th>
            <th><?php echo $this->Paginator->sort('duedate', 'Data de Vencimento'); ?></th>
            <th>Status</th>
            <th>
                <?php
                    echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                        array(
                            "controller"    => "transactions",
                            "action"        => "add"
                        ),
                        array(
                            'escape'        => false,
                            'rel'           => 'tooltip',
                            'title'         => 'Adicionar Movimento'
                        )
                    );
                ?>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?php echo $transaction['Transaction']['id']; ?></td>
                <td><?php echo h($transaction['Entity']['name']); ?></td>
                <td><?php echo h($transaction['Transaction']['type']); ?> </td>
                <td>
                    <?php
                        if ($transaction['Transaction']['type'] == 'Saída' )
                        {
                            print '<div style="color: red;">';
                        }
                    ?>

                    R$ <?php echo number_format($transaction['Transaction']['value'], 2, ',', '.'); ?>

                    <?php
                        if ($transaction['Transaction']['type'] == 'Saída' )
                        {
                            print '</div>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        echo date( 'd/m/Y', strtotime($transaction['Transaction']['duedate']) );
                    ?>
                </td>
                <td>
                    <?php
                        $duetime = strtotime($transaction['Transaction']['duedate']);
                        $duetime = mktime
                        (
                            0, 0, 0,
                            date('n', $duetime),
                            date('j', $duetime),
                            date('Y', $duetime)
                        );
                        $actualtime = mktime(0, 0, 0);

                        if ( $duetime < $actualtime )
                        {
                            print '<span class="label label-important">atraso</span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        echo $this->Html->link( '<i class="icon-zoom-in"></i>',
                            array(
                                "controller"    => "transactions",
                                "action"        => "view",
                                $transaction['Transaction']['id']
                            ),
                            array(
                                'escape'        => false,
                                'rel'           => 'tooltip',
                                'title'         => 'Detalhes do Movimento'
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
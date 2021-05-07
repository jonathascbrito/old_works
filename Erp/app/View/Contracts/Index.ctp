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
        echo $this->Html->link( "Contratos",
            array(
                "controller"    => "contracts",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Listar",
            array(
                "controller"    => "contracts",
                "action"        => "index"
            )
        );
    ?>
</div>

<div class="description">
    Lista com todos os contratos do escritório. Contratos são utilizados para facilitar os processos de feturamento e cobrança do escritóio.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id', '#'); ?></th>
            <th><?php echo $this->Paginator->sort('Entity.name', 'Entidade'); ?></th>
            <th><?php echo $this->Paginator->sort('type', 'Tipo'); ?></th>
            <th>Valor</th>
            <th>Vigência</th>
            <th>
                <?php
                    echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                        array(
                            "controller"    => "contracts",
                            "action"        => "add"
                        ),
                        array(
                            'escape'        => false,
                            'rel'           => 'tooltip',
                            'title'         => 'Adicionar Contrato'
                        )
                    );
                ?>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($contracts as $contract): ?>
            <tr>
                <td><?php echo $contract['Contract']['id']; ?> </td>
                <td><?php echo h($contract['Entity']['name']); ?> </td>
                <td><?php echo h($contract['Contract']['type']); ?> </td>
                <td>
                    R$ <?php echo number_format($contract['ContractValue'][0]['base'], 2, ',', '.'); ?>
                    <?php
                        $part = $contract['ContractValue'][0]['part'];
                        $percent = $contract['ContractValue'][0]['part_percent'];

                        if ( strstr($contract['Contract']['type'], 'Êxito') )
                        {
                            print " / ";

                            if ( $percent ) {
                                echo number_format($part, 0, ',', '.') . "%";
                            }else{
                                echo "R$ " . number_format($part, 2, ',', '.');
                            }
                        }
                    ?>
                </td>
                <td>
                    <?php
                        echo date( 'd/m/Y', strtotime($contract['ContractPeriod'][0]['start']) );
                        echo " à ";
                        echo date( 'd/m/Y', strtotime($contract['ContractPeriod'][0]['end']) );
                    ?>
                </td>
                <td>
                    <?php
                        echo $this->Html->link( '<i class="icon-zoom-in"></i>',
                            array(
                                "controller"    => "contracts",
                                "action"        => "view",
                                $contract['Contract']['id']
                            ),
                            array(
                                'escape'        => false,
                                'rel'           => 'tooltip',
                                'title'         => 'Detalhes do Contrato'
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
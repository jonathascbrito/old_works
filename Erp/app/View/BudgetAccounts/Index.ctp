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
        echo $this->Html->link( "Contas Orçamentárias",
            array(
                "controller"    => "budgetaccounts",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Listar",
            array(
                "controller"    => "budgetaccounts",
                "action"        => "index"
            )
        );
    ?>
</div>

<div class="description">
    Estrutura de contas orçamentárias do escritório. A vinculação com um plano de contas orçamentárias permite uma identificação mais fácil das receitas e despesas do escritório, possibilitando maior domínio na origem e aplicação dos recursos.
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
            <th><?php echo $this->Paginator->sort('BudgetAccount.code', 'Código'); ?></th>
            <th><?php echo $this->Paginator->sort('BudgetAccount.name', 'Nome'); ?></th>
            <th>
                <?php
                    echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                        array(
                            "controller"    => "budgetaccounts",
                            "action"        => "add"
                        ),
                        array(
                            'escape'        => false,
                            'rel'           => 'tooltip',
                            'title'         => 'Adicionar Conta Orçamentária'
                        )
                    );
                ?>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($budgetAccounts as $budgetAccount):
            $levels = count( explode( '.', $budgetAccount['BudgetAccount']['code'] ) ) -1;
            ?>
            <tr>
                <td>
                    <?php
                        if ( $terms ) :
                            $budgetAccount['BudgetAccount']['code'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $budgetAccount['BudgetAccount']['code']
                                );
                        endif;

                        echo $budgetAccount['BudgetAccount']['code'];
                    ?>
                </td>
                <td>
                    <?php
                        if ( $terms ) :
                            $budgetAccount['BudgetAccount']['name'] =
                                str_ireplace
                                (
                                    $terms, "<span class=\"filter\">{$terms}</span>",
                                    $budgetAccount['BudgetAccount']['name']
                                );
                        endif;

                        echo str_repeat( '--', $levels * 3 ) . " ";
                        echo $budgetAccount['BudgetAccount']['name'];
                    ?>
                </td>
                <td>
                    <?php
                        echo $this->Html->link( '<i class="icon-edit"></i>',
                            array(
                                "controller"    => "budgetaccounts",
                                "action"        => "edit",
                                $budgetAccount['BudgetAccount']['id']
                            ),
                            array(
                                'escape'        => false,
                                'rel'           => 'tooltip',
                                'title'         => 'Editar Conta Orçamentária'
                            )
                        );
                    ?>

                    <?php
                        echo $this->Html->link( '<i class="icon-remove"></i>',
                            array(
                                "controller"    => "budgetaccounts",
                                "action"        => "delete",
                                $budgetAccount['BudgetAccount']['id']
                            ),
                            array(
                                'escape'        => false,
                                'rel'           => 'tooltip',
                                'title'         => 'Remover Conta Orçamentária'
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
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
        echo $this->Html->link( "Tickets",
            array(
                "controller"    => "tickets",
                "action"        => "index"
            )
        );
    ?>
</div>

<div class="description">
    Está página de listagem dos tickets
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
            <th><?php echo $this->Paginator->sort('Ticket.number', 'Código'); ?></th>
            <th><?php echo $this->Paginator->sort('Ticket.status', 'Status'); ?></th>
            <th><?php echo $this->Paginator->sort('Ticket.priority', 'Prioridade'); ?></th>
            <th><?php echo $this->Paginator->sort('Ticket.problem_id', 'Tipo'); ?></th>
            <th><?php echo $this->Paginator->sort('Ticket.created', 'Data e hora de abertura'); ?></th>
            <th>
                <?php
                    echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                        array(
                            "controller"    => "tickets",
                            "action"        => "add"
                        ),
                        array(
                            'escape'        => false,
                            'rel'           => 'tooltip',
                            'title'         => 'Enviar novo Ticket'
                        )
                    );
                ?>
            </th>
        </tr>
    </thead>

    <tbody>
        <?php

        //@TODO: Deverá mostrar somente os tickets abertos pelo usuário para que seja editado

        /*
         * $usuario = id da entidade que criou
         * 
         * $perfil = perfil do usuário
         * 
         * $perfil = 2 (Admin) / 1 (usuário comum)
         * 
         */
        
        $perfil = 1;
        $usuario = 3;

        foreach ($tickets as $ticket):

            if($ticket['Ticket']['entity_id'] == $usuario || $perfil == 2):
        ?>
                <tr>
                    <td>
                        <?php
                            if ( $terms ) :
                                $ticket['Ticket']['number'] =
                                    str_ireplace
                                    (
                                        $terms, "<span class=\"filter\">{$terms}</span>",
                                        $ticket['Ticket']['number']
                                    );
                            endif;

                            echo $ticket['Ticket']['number'];
                        ?>
                    </td>
                    <td>
                        <?php
                            if ( $terms ) :
                                $ticket['Ticket']['status'] =
                                    str_ireplace
                                    (
                                        $terms, "<span class=\"filter\">{$terms}</span>",
                                        $ticket['Ticket']['status']
                                    );
                            endif;

                            echo $ticket['Ticket']['status'];

                        ?>
                    </td>
                    <td>
                        <?php
                            if ( $terms ) :
                                $ticket['Ticket']['priority'] =
                                    str_ireplace
                                    (
                                        $terms, "<span class=\"filter\">{$terms}</span>",
                                        $ticket['Ticket']['priority']
                                    );
                            endif;

                            echo $ticket['Ticket']['priority'];
                        ?>
                    </td>
                    <td>
                        <?php
                            if ( $terms ) :
                                $ticket['Problem']['problem'] =
                                    str_ireplace
                                    (
                                        $terms, "<span class=\"filter\">{$terms}</span>",
                                        $ticket['Problem']['problem']
                                    );
                            endif;

                            echo $ticket['Problem']['problem'];
                        ?>
                    </td>
                    
                    <td>
                        <?php
                            if ( $terms ) :
                                $ticket['Ticket']['created'] =
                                    str_ireplace
                                    (
                                        $terms, "<span class=\"filter\">{$terms}</span>",
                                        $ticket['Ticket']['created']
                                    );
                            endif;

                            echo date("d/m/Y - H:i:s", $ticket['Ticket']['created']);
                        ?>
                    </td>

                    <td>
                        <?php

                        /*
                        * Caso seja Usuário
                        * Avaliação caso o ticket já esteja fechado
                        * 
                        */

                        if($ticket['Ticket']['rating'] == false){

                            //@TODO: validação do perfil do usuário $perfil,
                            //pois tem opção de editar e administrar 2 = Admin e 1 = Usuário

                            if($ticket['Ticket']['status'] == 'Fechado' && $perfil == 1 ){

                                echo $this->Html->link('<i class="icon-comment"></i>', 
                                    array(
                                        "controller" => "tickets",
                                        "action" => "rating",
                                        $ticket['Ticket']['id']
                                    ), 
                                    array(
                                        'escape' => false,
                                        'rel' => 'tooltip',
                                        'title' => 'Avaliar a resposta do Ticket.'
                                    )
                                );

                            } else {
                                
                                // Aparece a opção para visualizar o ticket
                                
                                echo $this->Html->link('<i class="icon-comment"></i>', 
                                    array(
                                        "controller" => "tickets",
                                        "action" => "view",
                                        $ticket['Ticket']['id']
                                    ), 
                                    array(
                                        'escape' => false,
                                        'rel' => 'tooltip',
                                        'title' => 'Detalhes do ticket enviado.'
                                    )
                                );

                            }
                        } else {
                            
                            //@TODO: Colocar um imagem para informar que já foi finalizado e avaliado
                            echo "ok";
                            
                        }
                        ?>

                        <?php

                        //@TODO: colocar informações caso seja administração,
                        //pois tem opção de editar e administrar 2 = Admin e 1 = Usuário

                        if($perfil == 2){

                            echo $this->Html->link( '<i class="icon-edit"></i>',
                                array(
                                    "controller"    => "tickets",
                                    "action"        => "admin",
                                    $ticket['Ticket']['id']
                                ),
                                array(
                                    'escape'        => false,
                                    'rel'           => 'tooltip',
                                    'title'         => 'Administrar Ticket'
                                )
                            );

                        } else {
                            
                            if($ticket['Ticket']['status'] == 'Aberto'){
                                echo $this->Html->link( '<i class="icon-edit"></i>',
                                    array(
                                        "controller"    => "tickets",
                                        "action"        => "edit",
                                        $ticket['Ticket']['id']
                                    ),
                                    array(
                                        'escape'        => false,
                                        'rel'           => 'tooltip',
                                        'title'         => 'Editar Ticket'
                                    )
                                );
                            }
                        }
                        
                        ?>

                        <?php
                        
                            if($perfil == 2 || $ticket['Ticket']['status'] == 'Aberto'){
                                echo $this->Html->link( '<i class="icon-remove"></i>',
                                    array(
                                        "controller"    => "tickets",
                                        "action"        => "delete",
                                        $ticket['Ticket']['id']
                                    ),
                                    array(
                                        'escape'        => false,
                                        'rel'           => 'tooltip',
                                        'title'         => 'Apagar o Ticket'
                                    )
                                );
                            }
                        ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="pagination pagination-right">

    <div class="info">
        <?php

            //@TODO: Verificar o contador, pois é para apresentar somente os exibidos e não todos
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
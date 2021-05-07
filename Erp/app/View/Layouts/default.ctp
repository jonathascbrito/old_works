<!DOCTYPE html>
<html>

    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>

        <?php
            echo $this->Html->meta('icon');
            echo $this->fetch('meta');

            echo $this->Html->css('mvtl.bootstrap');
            echo $this->Html->css('mvtl.font');
            echo $this->Html->css('mvtl.main');
            echo $this->Html->css('mvtl.chat');
            echo $this->fetch('css');

            echo $this->Html->script('mvtl.jquery');
            echo $this->Html->script('mvtl.bootstrap');
            echo $this->Html->script('mvtl.basic');
            echo $this->Html->script('mvtl.chat');
            echo $this->fetch('script');
        ?>
    </head>

    <body>

        <div id="main">
            <div class="center">

                <div class="left">
                    <div id="logo-mvtl">
                        <?php echo $this->Html->image('logo-mvtl.png'); ?>
                    </div>

                    <div id="user">
                        <div class="info">
                            <?php
                                $user = $this->Session->read('User');

                                echo $this->Html->link(
                                    $user['Entity']['name'],
                                    array(
                                        "controller"    => "users",
                                        "action"        => "profile"
                                    ),
                                    array(
                                        "escape"        => false
                                    )
                                );
                            ?>

                            <div style="float: right;">
                            <?php
                                echo $this->Html->link(
                                    "[sair]",
                                    array(
                                        "controller"    => "logout"
                                    ),
                                    array(
                                        "escape"        => false
                                    )
                                );
                            ?>
                            </div>

                            <div class="roles">
                                <?php print $user['Role']['name']; ?>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                    <menu>
                        <ul>
                            <li>
                                <?php
                                    echo $this->Html->link( "Dashboard",
                                        array(
                                            "controller"    => "dashboard",
                                            "action"        => "index"
                                        ),
                                        array(
                                            "class"         => array(
                                                "no-border",
                                                "group",
                                                "dashboard",
                                                (
                                                    $this->params['controller'] == 'dashboard' and
                                                    $this->params['action']     == 'index'
                                                ) ? 'active' : ''
                                            )
                                        )
                                    );
                                ?>
                            </li>

                            <li>
                                <?php
                                    echo $this->Html->link( "Comunicação",
                                        array(
                                            "controller"    => "pages",
                                            "action"        => "home"
                                        ),
                                        array(
                                            "class"         => array(
                                                "group",
                                                "comunications"
                                            )
                                        )
                                    );
                                ?>

                                <ul>
                                    <li>
                                        <?php
                                            echo $this->Html->link( "Mensagens",
                                                array(
                                                    "controller"    => "messages",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "messages",
                                                        (
                                                            $this->params['controller'] == 'messages'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                            echo $this->Html->link( "Protocolos",
                                                array(
                                                    "controller"    => "protocols",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "protocols",
                                                        (
                                                            $this->params['controller'] == 'protocols'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                            echo $this->Html->link( "Tickets",
                                                array(
                                                    "controller"    => "tickets",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "protocols",
                                                        (
                                                            $this->params['controller'] == 'tickets'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>
                                </ul>

                            </li>

                            <li>
                                <?php
                                    echo $this->Html->link( "Cadastros",
                                        array(
                                            "controller"    => "pages",
                                            "action"        => "home"
                                        ),
                                        array(
                                            "class"         => array(
                                                "group",
                                                "registrations"
                                            )
                                        )
                                    );
                                ?>

                                <ul>
                                    <li>
                                        <?php
                                            echo $this->Html->link( "Estrutura Organizacional",
                                                array(
                                                    "controller"    => "organizationalstructure",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "entities",
                                                        (
                                                            $this->params['controller'] == 'organizationalstructure'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                            echo $this->Html->link( "Entidades",
                                                array(
                                                    "controller"    => "entities",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "entities",
                                                        (
                                                            $this->params['controller'] == 'entities'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>

                                    <li>
                                        <?php
                                            echo $this->Html->link( "Centros de Resultados",
                                                array(
                                                    "controller"    => "resultscenters",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "resultscenters",
                                                        (
                                                            $this->params['controller'] == 'resultscenters'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>

                                    <li>
                                        <?php
                                            echo $this->Html->link( "Contas Orçamentárias",
                                                array(
                                                    "controller"    => "budgetaccounts",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "budgetsaccounts",
                                                        (
                                                            $this->params['controller'] == 'budgetaccounts'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>

                                    <li>
                                        <?php
                                            echo $this->Html->link( "Impostos",
                                                array(
                                                    "controller"    => "taxes",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "taxes",
                                                        (
                                                            $this->params['controller'] == 'taxes'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>

                                    <li>
                                        <?php
                                            echo $this->Html->link( "Bancos",
                                                array(
                                                    "controller"    => "banks",
                                                    "action"        => "index"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "banks",
                                                        (
                                                            $this->params['controller'] == 'banks'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <?php
                                    echo $this->Html->link( "Financeiro",
                                        array(
                                            "controller"    => "pages",
                                            "action"        => "home"
                                        ),
                                        array(
                                            "class"         => array(
                                                "group",
                                                "financial",
                                                (
                                                    $this->params['controller'] == 'pages' and
                                                    $this->params['action']     == 'home'
                                                ) ? 'active' : ''
                                            )
                                        )
                                    );
                                ?>

                                <!--ul>
                                    <li>
                                        <?php
                                            echo $this->Html->link( "Faturamento",
                                                array(
                                                    "controller"    => "pages",
                                                    "action"        => "home"
                                                ),
                                                array(
                                                    "class"         => array(
                                                        "billing",
                                                        (
                                                            $this->params['controller'] == 'pages' and
                                                            $this->params['action']     == 'home'
                                                        ) ? 'active' : ''
                                                    )
                                                )
                                            );
                                        ?>
                                    </li>
                                </ul-->
                            </li>

                            <!--li>
                                <?php
                                    echo $this->Html->link( "Adminstrativo",
                                        array(
                                            "controller"    => "pages",
                                            "action"        => "home"
                                        ),
                                        array(
                                            "class"         => array(
                                                "group",
                                                "administrative",
                                                (
                                                    $this->params['controller'] == 'pages' and
                                                    $this->params['action']     == 'home'
                                                ) ? 'active' : ''
                                            )
                                        )
                                    );
                                ?>
                            </li-->

                            <li>
                                <?php
                                    echo $this->Html->link( "Gestão de Pessoas",
                                        array(
                                            "controller"    => "pages",
                                            "action"        => "home"
                                        ),
                                        array(
                                            "class"         => array(
                                                "group",
                                                "rh",
                                                (
                                                    $this->params['controller'] == 'pages' and
                                                    $this->params['action']     == 'home'
                                                ) ? 'active' : ''
                                            )
                                        )
                                    );
                                ?>
                            </li>

                            <li>
                                <?php
                                    echo $this->Html->link( "Qualidade",
                                        array(
                                            "controller"    => "pages",
                                            "action"        => "home"
                                        ),
                                        array(
                                            "class"         => array(
                                                "group",
                                                "quality",
                                                (
                                                    $this->params['controller'] == 'pages' and
                                                    $this->params['action']     == 'home'
                                                ) ? 'active' : ''
                                            )
                                        )
                                    );
                                ?>
                            </li>

                            <li>
                                <?php
                                    echo $this->Html->link( "Serviços",
                                        array(
                                            "controller"    => "pages",
                                            "action"        => "home"
                                        ),
                                        array(
                                            "class"         => array(
                                                "group",
                                                "services",
                                                (
                                                    $this->params['controller'] == 'pages' and
                                                    $this->params['action']     == 'home'
                                                ) ? 'active' : ''
                                            )
                                        )
                                    );
                                ?>
                            </li>
                        </ul>

                    </menu>
                </div>

                <div id="content" class="right">
                    <?php
                        echo $this->fetch( "content" );
                    ?>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

        <?php echo $this->element('sql_dump'); ?>

        <div id="chat">
            <a href="#" class="chat-list-toggle">
                Sala de Reunião
                <span class="closed"></span>
            </a>

            <div class="chat-list">
                <!--fieldset>
                    <legend>Lema</legend>
                    <a href="#" class="status-online">Felipe Ginja</a>
                    <a href="#" class="status-offline">Jonathas Brito</a>
                    <a href="#" class="status-online">Bruno Barbosa</a>
                </fieldset-->

                <fieldset>
                    <!--legend>ÍNTEGRO</legend>
                    <a href="#" class="status-online">Francisca Vasconcellos</a>
                    <a href="#" class="status-away">Maurício Vasconcellos</a-->
                    <a href="#">Nenhum usuário online</a>
                </fieldset>
                <!--/***** @TODO: Implementar busca ******/-->
            </div>
        </div>

    </body>

</html>
<h2>Módulo não instalado</h2>

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
            print $this->element( 'settings-link' );
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
</div>

<div class="description">
    Este módulo ainda não foi disponibilizado!<br>
    Em caso de dúvidas entre em contato com a equipe do Integro.
    <br><br>telefone: (71) 3016-0050
    <br>e-mail: suporte@lematec.com.br
</div>

<div class="content">
</div>
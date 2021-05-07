<div class="dropdown">
    <?php
        echo $this->Html->link( "Configurações",
            array(
                "controller"    => "settings",
                "action"        => "index"
            ),
            array(
                "class"         => array(
                    "settings",
                    "dropdown-toggle"
                ),
                "data-toggle"   => "dropdown"
            )
        );
    ?>
    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
        <li>
            <?php
                echo $this->Html->link( "Usuários",
                    array(
                        "controller"    => "users",
                        "action"        => "index"
                    )
                );
            ?>
        </li>
        <li class="divider"></li>
        <li>
            <?php
                echo $this->Html->link( "Perfis",
                    array(
                        "controller"    => "roles",
                        "action"        => "index"
                    )
                );
            ?>
        </li>
        <li>
            <?php
                echo $this->Html->link( "Permissões",
                    array(
                        "controller"    => "settings",
                        "action"        => "permissions"
                    )
                );
            ?>
        </li>
    </ul>
</div>
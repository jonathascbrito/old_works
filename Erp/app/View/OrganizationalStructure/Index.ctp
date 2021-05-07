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
        echo $this->Html->link( "Estrutura Organizacional",
            array(
                "controller"    => "organizationalstructure",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Listar",
            array(
                "controller"    => "organizationalstructure",
                "action"        => "index"
            )
        );
    ?>
</div>

<div class="description">
    Parametrização da estrutura organizacional do escritório.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type='text/javascript'>
    google.load('visualization', '1', {packages:['orgchart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
        data.addRows([

            [
                    {
                        v:'1',
                        f:'MVTL'
                        + '<div style="margin-top: 10px;">'
                        + '<?php
                                echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                                    array(
                                        "controller"    => "organizationalstructure",
                                        "action"        => "add",
                                        '1'
                                    ),
                                    array(
                                        'escape'        => false,
                                        'rel'           => 'tooltip',
                                        'title'         => 'Adicionar item abaixo de MVTL'
                                    )
                                );
                           ?>'
                        +  '</div>'
                    },
                    '',
                    'MVTL'
                ]


            <?php foreach ($organizationalUnits as $organizationalUnit): ?>
                <?php
                    $levels = $organizationalUnit['OrganizationalUnit']['code'];
                    $levels = explode('.', $levels);

                    if ( count($levels) == 0 )
                    {
                        $parent =  '';
                    }else{
                        array_pop($levels);
                        $parent = implode('.', $levels);
                    }
                ?>
                ,[
                    {
                        v:'<?php print $organizationalUnit['OrganizationalUnit']['code']; ?>',
                        f:'<?php print $organizationalUnit['OrganizationalUnit']['name']; ?>'
                        + '<div style="margin-top: 10px;">'
                        + '<?php
                                echo $this->Html->link( '<i class="icon-plus-sign"></i>',
                                    array(
                                        "controller"    => "organizationalstructure",
                                        "action"        => "add",
                                        $organizationalUnit['OrganizationalUnit']['code']
                                    ),
                                    array(
                                        'escape'        => false,
                                        'rel'           => 'tooltip',
                                        'title'         => 'Adicionar item abaixo de ' . $organizationalUnit['OrganizationalUnit']['name']
                                    )
                                );
                           ?>'
                        + '<?php
                                echo $this->Html->link( '<i class="icon-edit"></i>',
                                    array(
                                        "controller"    => "organizationalstructure",
                                        "action"        => "edit",
                                        $organizationalUnit['OrganizationalUnit']['id']
                                    ),
                                    array(
                                        'escape'        => false,
                                        'rel'           => 'tooltip',
                                        'title'         => 'Editar'
                                    )
                                );
                           ?>'
                        + '<?php
                                echo $this->Html->link( '<i class="icon-remove"></i>',
                                    array(
                                        "controller"    => "organizationalstructure",
                                        "action"        => "remove",
                                        $organizationalUnit['OrganizationalUnit']['id']
                                    ),
                                    array(
                                        'escape'        => false,
                                        'rel'           => 'tooltip',
                                        'title'         => 'Remover'
                                    )
                                );
                           ?>'
                        +  '</div>'
                    },
                    '<?php print $parent; ?>',
                    '<?php print $organizationalUnit['OrganizationalUnit']['name']; ?>'
                ]
            <?php endforeach; ?>
        ]);
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        chart.draw(data, {allowHtml:true});
    }
</script>

<div id="chart_div"></div>

</div>
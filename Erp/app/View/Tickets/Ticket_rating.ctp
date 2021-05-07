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
                    "controller"    => "pages",
                    "action"        => "settings"
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
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Avaliação",
            array(
                "controller"    => "tickets",
                "action"        => "rating",
                $ticket['Ticket']['id']
            )
        );
    ?>
</div>



<div class="content">
    <div class="description">
    Utilize essa página para avaliar o retorno do Help Desk quanto ao ticket enviado.
    </div>

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Ticket",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Ticket.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>
<fieldset>
    <legend>Dados do Solicitante</legend>
    <div class="control-group">
        <label class="control-label" for="TicketEntityId">Nome</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Entity']['name']; ?></div>
       
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="TicketEntityPhone">Tel de Contato</label>

        <div class="controls">
            <div class="text"><?php print "(".$ticket['Entity']['phone_area'].")".$ticket['Entity']['phone_number']; ?></div>
            
        </div>
    </div>
    <div class="control-group">
        <?php //@TODO: Verificar informação pois tabela de entities se encontrava sem informações de email ?>
        <label class="control-label" for="TicketEntityEmail">Email de Contato</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Entity']['email']; ?></div>
           
        </div>
    </div>
</fieldset>
    

<fieldset>
    <legend>Informações do Ticket</legend>

    <div class="control-group">
        <label class="control-label" for="TicketNumber">Número</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Ticket']['number']; ?></div>
            <span class="help-block">Número do ticket.</span>
        </div>
    </div>




    <div class="control-group">
        <label class="control-label" for="TicketProblemId">Tipo de Dificuldade</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Problem']['problem']; ?></div>
            <span class="help-block">Tipo de dificuldade</span>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="TicketDate">Data e Horário de Abertura</label>

        <div class="controls">
            <div class="text"><?php print date("d/m/Y - H:i:s", $ticket['Ticket']['created']); ?></div>
        </div>
    </div>

   
    <div class="control-group">
        <label class="control-label" for="TicketComputerId">Computador</label>

        <div class="controls">
            <div class="text"><?php print $ticket['Computer']['name']; ?></div>
        </div>
    </div>   
        
        <div class="control-group">
            <label class="control-label" for="TicketDeviceId">Equipamento</label>

            <div class="controls">
                <div class="text"><?php print $ticket['Device']['name']; ?></div>
            </div>
        </div>
        
</fieldset>

    <fieldset>

        <legend>Avaliação do Help Desk</legend>
        <div class="control-group">
            <label class="control-label" for="TicketRatingDifficultyResolved">Dificuldade Resolvida</label>

            <div class="controls">
                <?php
                    echo $this->Form->input
                    (
                        "TicketRating.difficulty_resolved",
                        array
                        (
                            "div" => false,
                            "label" => false,
                            "type"  => "select",
                            "options" => array
                            (
                                "Não" => "Dificuldade Não Resolvida",
                                "Sim" => "Dificuldade Resolvida"
                            )
                        )
                    );
                ?>

                <span class="help-block">Informe se a sua dificuldade foi solucionada</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="TicketRatingRating">Nota de atendimento</label>

            <div class="controls">
                <?php
                    echo $this->Form->input
                    (
                        "TicketRating.rating",
                        array
                        (
                            "div" => false,
                            "label" => false,
                            "type"  => "select",
                            "options" => array
                            (
                                "10" => "10",
                                "9" => "9",
                                "8" => "8",
                                "7" => "7",
                                "6" => "6",
                                "5" => "5",
                                "4" => "4",
                                "3" => "3",
                                "2" => "2",
                                "1" => "1",
                                "0" => "0"
                            )
                        )
                    );
                ?>

                <span class="help-block">Informe uma nota para o atendimento realizado</span>
            </div>
        </div>


<div class="control-group">
    <label class="control-label" for="TicketRatingObservation">Observação</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "TicketRating.observation",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "textarea"
                )
            );
        ?>

        <span class="help-block">Realize uma descrição completa do problema apresentado</span>
    </div>
</div>




    </fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>




<?php echo $this->Form->end( ); ?>

</div>







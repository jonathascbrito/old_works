<h2>O.S. Nº<?php echo $ticket['Ticket']['code_number']; ?>/<?php echo $ticket['Ticket']['code_year']; ?></h2>

<div class="body">

    <b>Empresa:</b><br>
    <p><?php echo $ticket['Entity']['name']; ?></p>
    
    <br><br>
    <b>Prioridade:</b><br>
    <p>                      
        <?php
            switch($ticket['Ticket']['priority']):
                case '0': echo 'Baixa'; break;
                case '1': echo 'Normal'; break;
                case '2': echo 'Urgente'; break;
            endswitch;
        ?>
    </p>
    
    <br><br>
    <b>Status: </b><br>
    <p><?php echo $ticket['Ticket']['status']; ?></p>
    
    <br><br>
    <b>Responsável Técnico: </b><br>
    <p><?php echo $ticket['User']['name']; ?></p>
    
    <br><br>
    <b>Solicitação: </b><br>
    <p><?php echo $ticket['Type']['name']; ?></p>
    
    <br><br>
    <b>Previsão da Visita:</b><br>
    <p><?php echo $ticket['Ticket']['service_date'].' - '.$ticket['Ticket']['service_time']; ?></p>
    
    
    <!--<b>Sistemas:</b><br> -->
    
    <?php /* foreach ($ticket['Entity']['Systems'] as $system) { ?>
    
        <?php echo $system['name']; ?><br>
    
    <?php } */?>
    
    <br><br>
    <?php 
        if($ticket['Ticket']['status'] == 'Fechado'){
            ?>
            <b>Data Execução:</b><br>
            <p><?php echo $ticket['Ticket']['service_date']; ?></p>

            <br><br>
            
            <b>Observação:</b><br>
            <p><?php echo $ticket['Ticket']['observation_close']; ?></p>

            <br><br>
            
            <?php
            
            
            
        }
        
        
    ?>
    <?php echo $this->App->createlink('Gerar Arquivo', '/modules/helpdesk/tickets/pdf_create/'.$ticket['Ticket']['id']); ?>

    <div class="form-actions right">
        <?php echo $this->App->createmodalbutton('Fechar', 'close'); ?>
    </div>

</div>
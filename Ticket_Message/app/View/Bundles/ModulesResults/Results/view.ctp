<h2><?php echo $entity['Entity']['name']; ?></h2>
<div class="body">
    <h3>Propostas: </h3>
    
    <table class="table" style="width: 100%; border-spacing: 0; border-collapse: collapse; ">
            <thead>
                <tr>
                    <th style="font-family: 'bold'; font-size: 14px; font-weight: normal; line-height: 14px; text-align: left; padding: 8px 5px; border-bottom: 1px solid #e5e5e5;">Serviço</th>
                    <th style="font-family: 'bold'; font-size: 14px; font-weight: normal; line-height: 14px; text-align: left; padding: 8px 5px; border-bottom: 1px solid #e5e5e5;">Data</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($contracts as $contract): ?>
                    <tr modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/contracts/view/' . $contract['Contract']['id']); ?>">
                        <td style="padding: 8px 5px; border-bottom: 1px solid #e5e5e5;"><?php echo $contract['Contract']['service']; ?></td>
                        <td style="padding: 8px 5px; border-bottom: 1px solid #e5e5e5;"><?php echo $contract['Contract']['date']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($contracts); ?>
            </tbody>
    </table>
    
    <?php /*
        foreach($contracts as $contract){
            print '<br><b>Serviço: </b>'.$contract['Contract']['service'].'';
            print '<b>Data: </b>'.$contract['Contract']['date'].'<br>';
        }*/
    ?>
    <br><br>
    <h3>Ordens de Serviço: </h3>
    
    <table class="table" style="width: 100%; border-spacing: 0; border-collapse: collapse;">
            <thead>
                <tr><th style="font-family: 'bold'; font-size: 14px; font-weight: normal; line-height: 14px; text-align: left; padding: 8px 5px; border-bottom: 1px solid #e5e5e5;"></th></tr>
            </thead>
        
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr modal-action="open" modal-url="<?php echo $this->App->createurl('/modules/helpdesk/tickets/view/' . $ticket['Ticket']['id']); ?>">
                        <td style="padding: 8px 5px; border-bottom: 1px solid #e5e5e5;"><?php echo $ticket['Ticket']['code_number'].'/'.$ticket['Ticket']['code_year']; ?></td>
                    </tr>

                <?php endforeach; ?>
                <?php unset($tickets); ?>
            </tbody>
    </table>
    
    
    <?php
    /*
        foreach($tickets as $ticket){
            print '<br><b>O.S. Nº: </b>'.$ticket['Ticket']['code_number'].'/'.$ticket['Ticket']['code_year'].'<br>';
        }
    */
    ?>
    
    <br><br>
    
    <div class="form-actions right">
        <?php echo $this->App->createmodalbutton('Fechar', 'close'); ?>
    </div>

</div>
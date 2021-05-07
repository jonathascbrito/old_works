<h2>Proposta</h2>

<div class="body">

    <b>Empresa:</b><br>
    <p><?php echo $contract['Entity']['name']; ?></p>
    
    <br><br>
    <b>Descrição:</b><br>
    <p><?php echo $contract['Contract']['description']; ?></p>
    
    <br><br>
    <b>Data:</b><br>
    <p><?php echo $contract['Contract']['date']; ?></p>
    
    <br><br>
    <b>Situação:</b><br>
    <p>
            <?php
                $this->App->setattribute('options', array('0' => 'Em Análise', '1' => 'Aceita', '2' => 'Recusada'));
                echo $this->App->createinput('', 'Contract.situation', 'radio');
            ?>
    </p>
    <br><br>
    <b>Descrição:</b><br>
    <p><?php echo $contract['Contract']['description']; ?></p>

    
    <?php if($contract['Attachments']){ ?>
        <br><b>Anexos:</b><br>

        <div class="attachments">
        <?php foreach($contract['Attachments'] as $attachment){ ?>

        <div class="file <?php echo  substr($attachment['name'], strrpos($attachment['name'], '.')+1); ?>">
            <span class="name" title="<?php echo $attachment['name']; ?>">
                <a href="<?php echo $this->App->createurl('/download/' . $attachment['id']); ?>">
                    <?php echo substr($attachment['name'], 0, 20) . (strlen($attachment['name']) > 20 ? '...' : ''); ?>
                </a>
            </span>
            <div class="size">
                <?php echo  substr($attachment['name'], strrpos($attachment['name'], '.')+1); ?>
                (<?php
                    $unit = 'b';
                    $size = (int) $attachment['size'];

                    if ($size>1024) {
                        $unit = 'kb';
                        $size = $size/1024;
                    }

                    if ($size>1024) {
                        $unit = 'mb';
                        $size = $size/1024;
                    }

                    if ($size>1024) {
                        $unit = 'gb';
                        $size = $size/1024;
                    }

                    echo number_format($size, 2, ',', '.') . $unit;
                ?>)
            </div>
        </div>
        <?php } ?>
        </div>
    <?php } ?>
      
    <div class="form-actions right">
        <?php echo $this->App->createmodalbutton('Fechar', 'close'); ?>
    </div>

</div>
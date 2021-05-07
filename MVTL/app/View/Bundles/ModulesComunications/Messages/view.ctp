<h2>Detalhes da Mensagem</h2>

<div class="body">

    <b>De:</b> <?php echo $messages['From']['name']; ?><br>
    <b>Para:</b> <?php echo $messages['To']['name']; ?><br>
    <b>Data:</b> <?php echo $this->App->createdate($messages['Message']['created']); ?>

    <br><br>

    <p><?php echo nl2br($messages['Message']['content']); ?></p>

    <?php if($messages['Attachments']){ ?>
        <br><b>Anexos:</b><br>

        <div class="attachments">
        <?php foreach($messages['Attachments'] as $attachment){ ?>

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
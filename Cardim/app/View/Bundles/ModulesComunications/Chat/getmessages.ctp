<?php
    ob_start();

    $last = 0;
    $first = true;
    $messages = array_reverse($messages, true);

    foreach ($messages as $message) {

        if ( $last != $message['From']['id'] ) {
            $last = $message['From']['id'];

            if ( ! $first ) {
            ?>
                <div class="chat-message-line"></div>
            <?php
            }

            ?>
                <div class="chat-message-data">
                    <?php echo $message['From']['name']; ?>:
                </div>
            <?php

            $first = false;
        }

        ?>

        <div class="chat-message"
             from="<?php echo $message['From']['id'] == $me ? 'sent' : 'received'; ?>">
            <?php echo nl2br($message['Chat']['content']); ?>
        </div>

    <?php }

    $content = ob_get_contents();
    ob_end_clean();

    echo json_encode(array(
        'status' => $status,
        'title' => '<div class="status ' . ($user[0][0]['Status'] != '0' ? 'online' : 'offline') . '"></div>' . $user[0]['User']['name'],
        'content' => $content
    ));
?>
<?php
    ob_start();

    foreach ($users as $user) {
        $this->App->setattribute('user-id', $user['User']['id']);
        $this->App->setattribute('class', $user[0]['Status'] ? 'online' : 'offline');

        if ( $user[0]['Status'] ) {
            $link = "javascript:app.chat.create('" . $user['User']['id'] . "', '" . $user['User']['name'] . "');";
        }else{
            //$link = 'javascript: void(0);';
            $link = "javascript:app.chat.create('" . $user['User']['id'] . "', '" . $user['User']['name'] . "');";
        }
        echo $this->App->createlink($user['User']['name'], $link);
    }
    echo '<br><br><input value="' . ($this->request->data['q'] ? $this->request->data['q'] : '') . '" style="width: 171px; padding: 5px; border:0; border-top: 1px solid #0099cc; position:fixed; bottom: 0px; font-family: \'regular\'; font-size: 12px; line-height: 12px;" name="q" onkeyup="app.chat.filter();"/>';

    $content = ob_get_contents();
    ob_end_clean();

    echo json_encode(array(
        'status' => $status,
        'title' => 'Sala de reunião',
        'content' => $content
    ));
?>
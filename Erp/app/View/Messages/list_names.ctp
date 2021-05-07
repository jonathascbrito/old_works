<?php

header('Content-type: application/json; charset=UTF-8');

$destinatarios_selecteds = array();
if (!empty($_GET['term'])) {
    foreach ($destinatarios as $destinatario) {


        $dname = $destinatario['protocols']['response_receiving_name'];


        if (stripos($dname, $_GET['term']) !== false) {
            array_push($destinatarios_selecteds, $dname);
        }
    }
}

echo json_encode($destinatarios_selecteds);
?>
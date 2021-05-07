<?php

header('Content-type: application/json; charset=UTF-8');


$colaboradores_selecteds = array();


if(!empty($_GET['term'])){
  foreach($colaboradores as $colaborador){
    if(strripos($colaborador['entities']['name'], $_GET['term']) !== false){
      array_push($colaboradores_selecteds, $colaborador['entities']['name']);
    }
  }
}

echo json_encode($colaboradores_selecteds);

?>
<?php

function run_sql_file($location){
    //load file
    $commands = file_get_contents($location);

    //delete comments
    $lines = explode(PHP_EOL,$commands);
    $commands = '';
    foreach($lines as $line){
        $line = trim($line);

        if( $line && substr($line, 0, 2) != '--' ){
            $commands .= $line . ' ';
        }
    }

    //convert to array
    $commands = explode(";", $commands);

    //run commands
    $total = $success = 0;
    $errors = array();
    foreach($commands as $command){
        $command = utf8_decode($command);

        if(trim($command)){
            if( mysql_query($command) ){
                $success++;
            }else{
                $errors[] = array('command' => $command, 'error' => mysql_error());
            }
            $total += 1;
        }
    }

    //return number of successful queries and total number of queries found
    return array(
        "success" => $success,
        "total" => $total,
        "errors" => $errors
    );
}

include dirname(__FILE__) . '/app/Config/database.php';

$db = new DATABASE_CONFIG;

$conn = mysql_connect($db->default['host'], $db->default['login'], $db->default['password']);
        mysql_select_db($db->default['database']);

        var_dump(run_sql_file('install.sql'));

        mysql_close($conn);

?>
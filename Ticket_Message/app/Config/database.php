<?php

/**
 * Define as conexões com o banco de dados. Para o correto funcionamento do
 * sistema pelo menos a conexão $default deve estar definida.
 */
class DATABASE_CONFIG
{

    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'gestao',
        'prefix' => '',
        'encoding' => 'utf8',
    );

}

?>
<?php

/**
 * Define as conexões com o servidores de e-mail. Para o correto funcionamento do
 * sistema pelo menos a conexão $default deve estar definida.
 */
class EmailConfig
{

    public $default = array(
        'charset' => 'utf-8',
        'headerCharset' => 'utf-8',
        
        'host' => 'mx1.hostinger.com.br',
        'port' => 110,
        'username' => 'noreply@mbtechnology.com.br',
        'password' => 'murilo123456',
        'from' => array('noreply@mvtl.com.br' => 'noreply'),
        
        'log' => true
    );

}

?>
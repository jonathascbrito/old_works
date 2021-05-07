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
        
        'host' => 'ssl://mail.mvtl.com.br',
        'port' => 465,
        'username' => 'noreply@mvtl.com.br',
        'password' => 'mvtl@1234',
        'from' => array('noreply@mvtl.com.br' => 'noreply'),
        
        'log' => true
    );

}

?>
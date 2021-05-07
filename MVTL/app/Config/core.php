<?php

/**
 * Requisito da versão 2.x.
 */
define('LOG_ERROR', LOG_ERR);

/**
 * Define o ambiente de execução da aplicação. Utilize 0 para produção, 1 para
 * testes e 2 para debug.
 */
Configure::write('debug', 2);

/**
 * Define os gerenciadores de erros da aplicação. Por padrão os métodos
 * handleError e handleException da classe ErrorHandler (cake).
 */
Configure::write('Error', array(
        'handler' => 'ErrorHandler::handleError',
        'level' => E_ALL & ~E_DEPRECATED,
        'trace' => false
));

Configure::write('Exception', array(
        'handler' => 'ErrorHandler::handleException',
        'renderer' => 'ExceptionRenderer',
        'log' => true
));

/**
 * Define a codificação da aplicação. É recomendado utilizar UTF-8 ou 16 para
 * garantir o correto funcionamento de caracteres especiais, como ã, ç...
 */
Configure::write('App.encoding', 'UTF-8');

/**
 * Define as configurações de sessão da aplicação. Substitui o controle de sessão
 * do php armazenando as informações no banco de dados.
 */
Configure::write('Session', array(
    'defaults' => 'database',
    'handler' => array(
        'model' => 'Session'
    )
));

/**
 * Define as configurações de segurança do sistema. Salt e CipherSeed, utilizados
 * para criptografar strings e números.
 */
Configure::write('Security.salt', 'DSF#4546tdFVBVADFSHkçéREE´56ç´56rterot');
Configure::write('Security.cipherSeed', '78499348093428534765867203894213409328');

/**
 * Helper responsável por adicionar a data de modificação ao final de arquivos
 * javascript e folhas de estilo garantindo que o navegador mantenha ou renove o
 * arquivo em cache.
 */
Configure::write('Asset.timestamp', true);

/**
 * Define o fuso horário do servidor para UTC (+0 GMT).
 */
date_default_timezone_set('UTC');

/**
 * Configura o cache do framework e dos modelos. Se disponível, utilizar um cache
 * em memória (apc, memcache).
 *
 * @todo: verificar a existência dos módulos apc ou memcache.
 */
$engine = 'File';
$duration = '+999 days';

Cache::config('_cake_core_', array(
    'engine' => $engine,
    'prefix' => 'mvtl_cake_core_',
    'path' => CACHE . 'persistent' . DS,
    'serialize' => ($engine === 'File'),
    'duration' => Configure::read('debug') >= 1 ? '+10 seconds' : $duration
));

Cache::config('_cake_model_', array(
    'engine' => $engine,
    'prefix' => 'mvtl_cake_model_',
    'path' => CACHE . 'models' . DS,
    'serialize' => ($engine === 'File'),
    'duration' => Configure::read('debug') >= 1 ? '+10 seconds' : $duration
));

include dirname(__FILE__) . DS . 'notifications.php';

?>
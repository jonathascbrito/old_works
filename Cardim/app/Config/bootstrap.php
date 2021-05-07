<?php
/**
 * Define o armazenamento padrão utilizado pela classe Cache. Se disponível,
 * utilizar um cache em memória (apc, memcache).
 *
 * @todo: verificar a existência dos módulos apc ou memcache.
 */
Cache::config('default', array('engine' => 'File'));

/**
 * Configura os Logs definindo os tipos de erros e arquivos utilizados a depender
 * do ambiente de execução (debug, error).
 */
App::uses('CakeLog', 'Log');

CakeLog::config('debug', array(
    'engine' => 'FileLog',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));

CakeLog::config('error', array(
    'engine' => 'FileLog',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));

/**
 * Define os filtros carregados e registrados como EventListeners durante a
 * inicialização do framework.
 */
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

?>
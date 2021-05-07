<?php

/**
 * Message
 *
 * Define o modelo message. Este modelo representa as mensagens trocadas entre os
 * usuários do sistema.
 */
class Complement extends AppModel {

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    /**
     * Define os relacionamentos do tipo n-1.
     * @var array
     */
    public $belongsTo = array(
        'Ticket' => array(
            'className' => 'Ticket',
            'foreignKey' => 'ticket_id'
        )
    );

    /**
     * Define os relacionamentos do tipo n-n.
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Tests' => array(
            'className' => 'Test',
            'joinTable' => 'complements_tests',
            'foreignKey'=> 'test_id',
            'order' => 'Tests.name asc'
        )
    );

    /**
     * Define as regras de validação do modelo.
     * @var array
     */

}

?>
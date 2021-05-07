<?php

/**
 * Chat
 *
 * Define o modelo chat. Este modelo representa as mensagens rápidas trocadas
 * entre os usuários do sistema.
 */
class Chat extends AppModel {

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
        'To' => array(
            'className' => 'User',
            'foreignKey' => 'to'
        ),
        'From' => array(
            'className' => 'User',
            'foreignKey' => 'from'
        )
    );

    /**
     * Define as regras de validação do modelo.
     * @var array
     */
    public $validate = array(
        'to' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o usuário de destino.',
                'required' => true
            )
        ),
        'from' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o usuário remetente.',
                'required' => true
            )
        ),
        'content' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o conteúdo da mensagem.',
                'required' => true
            )
        )
    );

}

?>
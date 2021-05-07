<?php

/**
 * Role
 *
 * Define o modelo role. Este modelo representa os perfis de usuários cadastrados
 * no sistema.
 */
class Test extends AppModel {

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    /**
     * Define os relacionamentos do tipo n-n.
     * @var array
    */ 
    public $hasAndBelongsToMany = array(
        'Complements' => array(
            'className' => 'Complement',
            'joinTable' => 'complements_tests'
        )
    );
    
    /**
     * Define as regras de validação do modelo.
     * @var array
     */
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o nome do sistema.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O sistema informado já está cadastrado.',
                'required' => true
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma descrição para o sistema.',
                'required' => true
            )
        )
    );

}

?>
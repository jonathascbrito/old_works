<?php

/**
 * Role
 *
 * Define o modelo role. Este modelo representa os perfis de usuários cadastrados
 * no sistema.
 */
class Role extends AppModel {

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
        'Users' => array(
            'className' => 'User',
            'joinTable' => 'users_roles',
            'order' => 'Users.name asc'
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
                'message' => 'Informe o nome do perfil.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O perfil informado já está cadastrado.',
                'required' => true
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma descrição para o perfil.',
                'required' => true
            )
        )
    );

}

?>
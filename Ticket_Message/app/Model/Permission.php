<?php

/**
 * Protocol
 *
 * Define o modelo protocol. Este modelo representa os protocolos cadastrados no
 * sistema.
 */
class Permission extends AppModel {

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
        'Roles' => array(
            'className' => 'Role',
            'joinTable' => 'roles_permissions',
            'unique' => 'keepExisting'
        )
    );

}

?>
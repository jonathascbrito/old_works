<?php

/**
 * Entity
 *
 * Define o modelo entity. Este modelo representa as entidades cadastradas no
 * sistema.
 */
class Entity extends AppModel {

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    /**
     * Define os relacionamentos do tipo n-1.
     * @var array
     */
    
    /*public $belongsTo = array(
        'Group' => array(
            'className' => 'Entity',
            'foreignKey' => 'entity_id'
        ),
        'OrganizationalStructure' => array(
            'className' => 'OrganizationalStructure',
            'foreignKey' => 'organizational_structure_id'
        )        
    );*/
    
    /**
     * Define os relacionamentos do tipo n-1.
     * @var array
     */
    /*public $hasMany = array(
        'Contracts' => array(
            'className' => 'Contract',
            'foreignKey' => 'entity_id',
            'dependent' => true
        ),
        'Tickets' => array(
            'className' => 'Ticket',
            'foreignKey' => 'entity_id',
            'dependent' => true
        )
    );*/
    
    /**
     * Define os relacionamentos do tipo n-n.
     * @var array
     */

    public $hasAndBelongsToMany = array(
        'Systems' => array(
            'className' => 'System',
            'joinTable' => 'entities_systems',
            'order' => 'Systems.name asc'
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
                'message' => 'Informe o nome da entidade.',
                'required' => true
            )
        )/*,
        'number' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o cpf/cnpj da entidade.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O cpf/cnpj informado já está cadastrado.',
                'required' => true
            )
        )*/
    );

}

?>
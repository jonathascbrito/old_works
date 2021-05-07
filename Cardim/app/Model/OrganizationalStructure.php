<?php

/**
 * OrganizationalStructure
 *
 * Define o modelo organizationalstructure. Este modelo representa a estrutura
 * organizacional da empresa.
 */
class OrganizationalStructure extends AppModel {

    /**
     * Define a tabela utilizada para guardar os dados do modelo.
     * @var string
     */
    public $useTable = 'organizational_structure';

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    /**
     * Define as regras de validação do modelo.
     * @var array
     */
    public $validate = array(
        'code' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o código do nível organizacional.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O código informado já está sendo utilizado.',
                'required' => true
            )
        ),
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe um nome para o nível organizacional.',
                'required' => true
            )
        )
    );

}

?>
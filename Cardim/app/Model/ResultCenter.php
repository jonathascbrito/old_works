<?php

/**
 * ResultCenter
 *
 * Define o modelo resultcenter. Este modelo representa os centros de resultados
 * do sistema.
 */
class ResultCenter extends AppModel {

    /**
     * Define a tabela utilizada para guardar os dados do modelo.
     * @var string
     */
    public $useTable = 'results_centers';

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
                'message' => 'Informe o código do centro de resultados.',
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
                'message' => 'Informe um nome para o centro de resultados.',
                'required' => true
            )
        )
    );


    /**
     * Construtor do modelo. Configura o campo virtual "qualified_name",
     * responsável por exibir uma versão completa do código e nome de um centro
     * de resultados.
     *
     * @param mixed $id
     * @param string $table
     * @param mixed $ds
     */
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->virtualFields['qualified_name'] = sprintf
        (
            'CONCAT(%s.code, " - ", %s.name)',
            $this->alias,
            $this->alias
        );
    }

}

?>
<?php

/**
 * TicketDevice
 *
 * Define o modelo ticketdevice. Este modelo representa os equipamentos do
 * módulo helpdesk.
 */
class TicketDevice extends AppModel {

    /**
     * Define a tabela utilizada para guardar os dados do modelo.
     * @var string
     */
    public $useTable = 'tickets_devices';

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    public $hasMany = array(
        'Tickets' => array(
            'className' => 'Ticket',
            'foreignKey' => 'ticket_device_id',
            'dependent' => true
        )
    );
    
    /**
     * Define as regras de validação do modelo.
     * @var array
     */
    public $validate = array(
        'type' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o tipo do equipamento (computador, impressora).',
                'required' => true
            )
        ),
        'code' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o código do equipamento.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O código informado já está cadastrado.',
                'required' => true
            )
        ),
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe um nome para o equipamento.',
                'required' => true
            )
        )
    );


    /**
     * Construtor do modelo. Configura o campo virtual "qualified_name",
     * responsável por exibir uma versão completa do código, tipo e nome de um
     * equipamento.
     *
     * @param mixed $id
     * @param string $table
     * @param mixed $ds
     */
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->virtualFields['qualified_name'] = sprintf
        (
            'CONCAT(%s.type, ": ", %s.code, " - ", %s.name)',
            $this->alias,
            $this->alias,
            $this->alias
        );
    }

}

?>
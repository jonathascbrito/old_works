<?php

/**
 * TicketType
 *
 * Define o modelo tickettype. Este modelo representa os tipos de tickets do
 * módulo helpdesk.
 */
class TicketType extends AppModel {

    /**
     * Define a tabela utilizada para guardar os dados do modelo.
     * @var string
     */
    public $useTable = 'tickets_types';

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    public $hasMany = array(
        'Tickets' => array(
            'className' => 'Ticket',
            'foreignKey' => 'ticket_type_id',
            'dependent' => true
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
                'message' => 'Informe o tipo de ticket.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O nome informado já está cadastrado.',
                'required' => true
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma descrição para o tipo de ticket.',
                'required' => true
            )
        )
    );

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->virtualFields['qualified_name'] = sprintf
        (
            'CONCAT(%s.name, "<div style=\'color: #999; font-style: italic; font-size:11px;\'>", %s.description, "</div>")',
            $this->alias,
            $this->alias
        );
    }
    
}

?>
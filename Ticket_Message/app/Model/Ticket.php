<?php

/**
 * Ticket
 *
 * Define o modelo ticket. Representa os chamados cadastrados no módulo helpdesk.
 */
class Ticket extends AppModel {

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    /**
     * Define os relacionamentos do tipo n-n.
     * @var array
     */

    /*public $hasAndBelongsToMany = array(
        'Systems' => array(
            'className' => 'System',
            'joinTable' => 'tickets_systems',
            'unique' => 'keepExisting',
            'order' => 'Systems.name asc'
        )
    );*/
    
    
    /**
     * Define os relacionamentos do tipo n-1.
     * @var array
     */
    public $belongsTo = array(
        'Entity' => array(
            'className' => 'Entity',
            'foreignKey' => 'entity_id',
            'dependent' => true
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'dependent' => true
        ),
        'Type' => array(
            'className' => 'TicketType',
            'foreignKey' => 'ticket_type_id',
            'dependent' => true
        ),
        
    );
    
    /*public $hasAndBelongsToMany = array(
        'Tests' => array(
            'className' => 'Test',
            'joinTable' => 'tickets_tests',
            'order' => 'Tests.name asc'
        )
    );
    */

    /**
     * Define as regras de validação do modelo.
     * @var array
     */
    public $validate = array(
        'entity_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a entidade vinculada ao contrato.',
                'required' => true
            )
        ),
        'user_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o técnico responsável.',
                'required' => true
            )
        ),
        'priority' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o nível de prioridade do chamado.',
                'required' => true
            )
        ),
        'status' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o status do chamado.',
                'required' => true
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma descrição para o chamado.',
                'required' => true
            )
        ),
        'service_date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe a data de atendimento.',
                'required' => true
            )
        ),
        'service_time' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o horário do atendimento.',
                'required' => true
            )
        )
    );

    /**
     * Método executado antes de salvar um modelo. Garante que o número do
     * ticket seja gerado corretamente.
     *
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        $this->data['Ticket']['code_year'] = date('Y');

        $last = $this->field('code_number', array('Ticket.code_year' => date('Y')), 'Ticket.created desc');
        $last = $last ? $last : 0;
        $last = (int) $last + 1;

        $this->data['Ticket']['code_number'] = str_pad($last, 5, '0', STR_PAD_LEFT);

        return parent::beforeSave($options);
    }

}

?>
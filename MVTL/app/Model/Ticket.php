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
     * Define os relacionamentos do tipo n-1.
     * @var array
     */
    public $belongsTo = array(
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
        'Device' => array(
            'className' => 'TicketDevice',
            'foreignKey' => 'ticket_device_id',
            'dependent' => true
        )
    );

    /**
     * Define as regras de validação do modelo.
     * @var array
     */
    public $validate = array(
        'user_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o usuário solicitante.',
                'required' => true
            )
        ),
        'ticket_type_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o tipo de ticket.',
                'required' => true
            )
        ),
        'ticket_device_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o equipamento com problema.',
                'required' => true
            )
        ),
        'priority' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o nível de prioridade do ticket.',
                'required' => true
            )
        ),
        'status' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o status do ticket.',
                'required' => true
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma descrição para o ticket.',
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

        $this->data['Ticket']['code_number'] = str_pad($last, 15, '0', STR_PAD_LEFT);

        return parent::beforeSave($options);
    }

}

?>
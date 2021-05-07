<?php
App::uses('AppModel', 'Model');

class Protocol extends AppModel
{
    public $name = 'Protocol';

     public $belongsTo = array
    (
        'Entity' => array
        (
            'className'  => 'Entity',
            'order'      => 'Entity.name ASC'
        ),
         'OrganizationalUnit' => array
         (
            'foreignKey' => 'organizational_unit_id_receiving',
            'className'  => 'OrganizationalUnit',
            'order'      => 'OrganizationalUnit.name ASC'
        ),
         'EntityReceiving' => array
         (
             'foreignKey' => 'response_receiving_id',
             'className' => 'Entity',
             'order'     => 'Entity.name ASC'
         ),
         'EntityLogistic' => array
         (
             'foreignKey' => 'logistic_response_id',
             'className' => 'Entity',
             'order'     => 'Entity.name ASC'
         )
    );

     public $validate = array(
        'entity_id' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione um solicitante!'
        ),
        'type' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Selecione o tipo do protocolo!'
        ),
         'priority' => array(
             'rule'     => 'notEmpty',
             'required' => true,
             'message'  => 'Informe a prioridade!'
         ),
         'description' => array(
             'rule'     => 'notEmpty',
             'required' => true,
             'message'  => 'Informe a descriçao do protocolo!'
         ),
         'logistic_response_id' => array(
             'rule'     => array('notEmptyIf', 'type', 'Externo'),
             'required' => true,
             'message'  => 'Informe o responsável pela logística!'
         ),
         'response_receiving_name' => array(
             'rule'     => array('notEmptyIf', 'type', 'Externo'),
             'required' => true,
             'message'  => 'Informe o destinatário!'
         )
    );

    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);

        $this->virtualFields['create_date_formated'] = sprintf
        (
            'DATE_FORMAT( %s.create_date,  \'%%d/%%m/%%Y\' )',
            $this->alias
        );
    }

}
?>

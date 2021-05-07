<?php

App::uses('AppModel', 'Model');

class OrganizationalUnit extends AppModel
{
    public $name = 'OrganizationalUnit';

    public $findMethods = array
    (
        'analytic' =>  true
    );

    protected function _findAnalytic($state, $query, $results = array()) {
        if ($state == 'before')
        {
            return $query;
        }

        if ($state == 'after')
        {
            $list = array();
            $level = $query['level'];

            $level = str_replace('.', '\.', $level);
            $level = str_replace('%', '.+', $level);
            $level = "#^{$level}#u";

            foreach( $results as $result )
            {
                $field_id = explode('.', $query['fields'][0]);
                $field_value = explode('.', $query['fields'][1]);

                $match = preg_match
                (
                    $level,
                    $result[$field_value[0]][$field_value[1]]
                );

                $list[] = array(
                    'name'      => $result[$field_value[0]][$field_value[1]],
                    'value'     => $result[$field_id[0]][$field_id[1]],
                    'disabled'  => ! $match
                );
            }

            return $list;
        }

        return $results;
    }

    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);

        $this->virtualFields['qualified_name'] = sprintf
        (
            'CONCAT(%s.code, " - ", %s.name)',
            $this->alias,
            $this->alias
        );
    }

    public $validate = array(
        'code' => array(
            array
            (
                'rule'       => 'notEmpty',
                'required'   => true,
                'message'    => 'Informe um nível para o item!'
            ),
            array
            (
                'rule'       => 'isUnique',
                'required'   => true,
                'message'    => 'O nível informado já existe!'
            )
        ),
        'name' => array(
            'rule'       => 'notEmpty',
            'required'   => true,
            'message'    => 'Informe um nome para o item!'
        )
    );
}

?>
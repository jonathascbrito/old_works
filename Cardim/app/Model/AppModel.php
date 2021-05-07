<?php

/**
 * Registra a classe model.
 */
App::uses('Model', 'Model');

/**
 * AppModel
 *
 * Classe padrão dos modelos da aplicação. Sobreescreve os métodos save e saveAll
 * e define filtros para facilitar o funcionamento das classes auxiliares.
 */
class AppModel extends Model
{

    //@todo: verificar a possibilidade de adicionar os campos created, updated e
    //owner a tabelas de relacionamento.

    /**
     * Filtro executado após um consulta ser executada no modelo. Altera a forma
     * como dados de relacionamentos de n para n são organizados.
     *
     * @param array $results
     * @param boolean $primary
     * @return array
     */
    public function afterFind($results, $primary = false) {
        foreach ( array_keys($this->hasAndBelongsToMany) as $model ) {

            foreach ($results as $i=>$result) {
                if( isset($result[$model]) ) {

                    foreach( $result[$model] as $relation )
                        $results[$i][$this->name][$model][] = (int) $relation['id'];
                }
            }

        }

        return parent::afterFind($results, $primary);
    }

    /**
     * Método executado antes de salvar um modelo. Garante que relacionamentos do
     * tipo n para n sejam salvas corretamente e adiciona a coluna 'owner' com o
     * id do usuário logado.
     *
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        foreach ( $this->hasAndBelongsToMany as $model => $habtm ) {

            if( isset($this->data[$this->name][$model]) ) {
                $this->data[$model][$model] = $this->data[$this->name][$model];
            }

        }

        if(class_exists('AuthComponent'))
            $this->data[$this->name]['owner'] = AuthComponent::user('id');

        return parent::beforeSave($options);
    }

    /**
     * Sobreescreve o método save garantindo que a coluna modified esteja em
     * branco. Ela será preenchida automaticamente pelo framework.
     *
     * @param array $data
     * @param boolean $validate
     * @param array $fieldList
     * @return mixed
     */
    public function save($data = null, $validate = true, $fieldList = array()) {
        $this->set($data);

        if (isset($this->data[$this->alias]['modified'])) {
            unset($this->data[$this->alias]['modified']);
        }

        return parent::save($this->data, $validate, $fieldList);
    }

    /**
     * Sobreescreve o método saveAll definindo as configurações padrões da
     * aplicação.
     *
     * @param array $data
     * @param array $options
     * @return mixed
     */
    public function saveAll($data = null, $options = array()) {
        if ( ! isset($options['deep']) )
            $options['deep'] = true;

        if ( ! isset($options['atomic']) )
            $options['atomic'] = true;

        return parent::saveAll($data, $options);
    }

}

?>
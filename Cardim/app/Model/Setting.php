<?php

/**
 * Setting
 *
 * Define o modelo setting. Representa um parâmetro de configuração do sistema.
 */
class Setting extends AppModel {

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;


    /**
     * Método executado antes de salvar um modelo. Garante que novos parâmetros
     * não sejam adicionados ao sistema.
     *
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        if ( ! $this->id) {
            return false;
        }

        $data = $this->data;

        $this->data = array();
        $this->data['Setting']['id'] = $data['Setting']['id'];
        $this->data['Setting']['value'] = $data['Setting']['value'];
        $this->data['Setting']['modified'] = $data['Setting']['modified'];

        return parent::beforeSave($options);
    }

}

?>
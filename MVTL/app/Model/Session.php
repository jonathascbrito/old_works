<?php

/**
 * User
 *
 * Define o modelo user. Este modelo representa os usuários cadastrados no
 * sistema.
 */
class Session extends AppModel
{

    /**
     * Substitui o método save adicionando o campo user_id aos valores. Esta
     * alteração permite diferenciar usuários anônimos de usuários autenticados
     * sem a necessidade de ler os dados da sessão.
     *
     * @param array $data
     * @param boolean $validate
     * @param array $fieldList
     * @return boolean
     */
    public function save($data = null, $validate = true, $fieldList = array()) {
        if (isset($_SESSION['Auth']['User']['id'])) {
            $data['user_id'] = $_SESSION['Auth']['User']['id'];
        }else{
            $data['user_id'] = null;
        }

        return parent::save($data, $validate, $fieldList);
    }

}

?>
<?php

/**
 * Attachment
 *
 * Define o modelo attachment. Este modelo representa arquivos anexados pelo
 * sistema.
 */
class Attachment extends AppModel {

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
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nome do arquivo inválido.',
                'required' => true
            )
        ),
        'mime' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Tipo do arquivo inválido.',
                'required' => true
            )
        ),
        'size' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Tamanho do arquivo inválido.',
                'required' => true
            )
        )
    );

    /**
     * Sobreescreve o método save garantindo que o envio tenha ocorrido sem erros
     * antes de sua inserção no banco.
     *
     * @param array $data
     * @param boolean $validate
     * @param array $fieldList
     * @return mixed
     */
    public function save($data = null, $validate = true, $fieldList = array()) {
        if ($data['Attachment']['error'] === UPLOAD_ERR_OK) {

            $filepath = APP . 'uploads' . DS
                      . date('Y') . DS
                      . date('m') . DS;

            if ( ! is_dir($filepath)) {
                    mkdir($filepath, 0777, true);
            }

            $filepath = $filepath . String::uuid();

            if (move_uploaded_file($data['Attachment']['tmp_name'], $filepath)) {
                $this->data['Attachment']['name'] = $data['Attachment']['name'];
                $this->data['Attachment']['mime'] = $data['Attachment']['type'];
                $this->data['Attachment']['size'] = $data['Attachment']['size'];

                $this->data['Attachment']['path'] = $filepath;

                return parent::save($this->data, $validate, $fieldList);
            }
        }

        return false;
    }

    /**
     * Sobreescreve o método delete garantindo que o arquivo seja removido do disco
     * antes de sua remoção do banco.
     *
     * @param integer $id
     * @param boolean $cascade
     * @return mixed
     */
    public function delete($id = null, $cascade = true) {
        $file = $this->read(null, $id);

        if ($file and unlink($file['Attachment']['path'])) {
            return parent::delete($id, $cascade);
        }

        return false;
    }

}

?>
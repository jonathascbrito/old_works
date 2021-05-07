<?php

App::uses('AppModel', 'Model');

class MessageContent extends AppModel
{
    public $name = 'MessageContent';

    public $belongsTo = array
    (
        'Message' => array
        (
            'className'  => 'Message',
            'order'      => 'Message.id ASC'
        ),
        'EntitySender' => array
        (
            'foreignKey' => 'sender_id',
            'className' => 'Entity'
        )
    );

    public $validate = array
    (
        'text_content' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'O campo mensagem não pode ficar em branco!'
        )
    );

    function beforeSave( $options = Array() ) {
        if ( isset($this->data['MessageContent']['attachment']) ) {
            extract($this->data['MessageContent']['attachment']);

            if ($size && !$error) {
                $destination = APP_DIR . DS . WEBROOT_DIR . DS . 'files'. DS . time() . '-' . $name;

                move_uploaded_file($tmp_name, ROOT . DS . $destination);
                $this->data['MessageContent']['attachment'] = $name;
                $this->data['MessageContent']['attachment_path'] = $destination;
            }else{
                $this->data['MessageContent']['attachment'] = null;
            }
        }

        return true;
    }


}

?>
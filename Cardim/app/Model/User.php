<?php

/**
 * User
 *
 * Define o modelo user. Este modelo representa os usuários cadastrados no
 * sistema.
 */
class User extends AppModel {

    /**
     * Define o nível padrão de recursividade do modelo.
     * @var integer
     */
    public $recursive = -1;

    /**
     * Define os relacionamentos do tipo n-n.
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Roles' => array(
            'className' => 'Role',
            'joinTable' => 'users_roles',
            'unique' => 'keepExisting',
            'order' => 'Roles.name asc'
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
                'message' => 'Informe o nome do usuário.',
                'required' => true
            )
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'O e-mail informado é inválido.',
                'required' => true
            ),
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o e-mail do usuário.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O e-mail informado já está vinculado a outro usuário.',
                'required' => true
            )
        ),
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe um nome de usuário.',
                'required' => true
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'O nome de usuário informado já existe.',
                'required' => true
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe uma senha para o usuário.',
                'required' => true,
                'on' => 'create'
            )
        ),
        'active' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Informe o status do usuário.',
                'required' => true
            )
        )
    );

    /**
     * Método executado antes de salvar um modelo. Garante que as senhas de
     * usuários sejam criptografadas antes de enviá-las para o banco..
     *
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }

        return parent::beforeSave($options);
    }

    /**
     * Redefine a senha do usuário e o notifica por e-mail utilizando o template
     * informado.
     *
     * @param boolean $notify
     * @param string $subject
     * @param string $template
     * @return boolean
     */
    public function generatePassword($notify = true, $subject = null, $template = null) {
        $user = $this->read();

        $user['User']['password'] = substr(
            str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6
        );

       if ( ! $this->save($user)) {
           return false;
       }

       if ( ! $notify) return true;

       App::uses('CakeEmail', 'Network/Email');

       $email = new CakeEmail('default');

       $email->emailFormat('html');
       $email->template('../../Bundles/Mail/' . $template, 'email');

       $email->viewVars(array(
           'user' => $user
       ));

       $email->subject($subject)->to($user['User']['email']);

       return $email->send();
    }

}

?>
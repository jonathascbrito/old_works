<?php

App::uses('AppController', 'Controller');

class MessagesController extends AppController {

    public $name = 'Messages';
    public $uses = array
        (
        'Entity',
        'Message',
        'MessageContent'
    );
    public $paginate = array
        (
        'limit' => 25,
        'order' => array
            (
            'id' => 'desc'
        )
    );

    public function setResources() {
        $this->set('entities', $this->Entity->find
                        (
                        "list", array
                    (
                    "recursive" => 1,
                    "fields" => array('Entity.id', 'Entity.name', 'Entity.type'),
                    "order" => array('Entity.name asc')
                        )
                )
        );

        $this->set('messageContents', $this->MessageContent->find
                        (
                        "list", array
                    (
                    "recursive" => 1,
                    "order" => array('MessageContent.id')
                        )
                ));
    }

    public function index() {
        $this->set('controller_name', 'Menssages');
        $this->set('controller_action', 'Listar');

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Message.subject LIKE" => "%{$terms}%",
                    "Message.sender_status LIKE" => "%{$terms}%",
                    "Entity.receiver_status LIKE" => "%{$terms}%"
                )
            );
        endif;

//@TODO: trocar o 1
        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('messages', $this->paginate('Message', array('or' => array('Message.sender_id' => 1, 'Message.receiver_id' => 1))));
        $this->render('Index');
    }

    public function add() {
        $this->set('controller_name', 'Mensagens');
        $this->set('controller_action', 'Adicionar');

        if ($this->request->is('post') or $this->request->is('put')) {

            //@TODO: trocar o 1
            $this->request->data['Message']['sender_id'] = 1;


            $receiver_id = $this->Entity->query(
                    "
                    select id from entities where name = '" . $this->request->data['Message']['receiver_name'] . "';
                "
            );

            ($receiver_id == null ? $this->request->data['Message']['receiver_id'] = null : $this->request->data['Message']['receiver_id'] = $receiver_id[0]['entities']['id']);

            $this->request->data['Message']['sender_status'] = 'Enviada';
            $this->request->data['Message']['receiver_status'] = 'Nova Mensagem';
            $this->request->data['MessageContent'][0]['sender_id'] = 1; //@TODO: trocar o 1

            parent::save(
                    "Message", "Mensagem enviada com sucesso!", "Houve um problema ao enviar a mensagem!"
            );
        }


        $this->setResources();
        $this->render('form');
    }

    public function view($id) {
        $this->set('controller_name', 'Mensagens');
        $this->set('controller_action', 'Detalhes');

        $this->Message->id = $id;
        $this->set('message', $this->Message->find
                        (
                        'first', array
                    (
                    'recursive' => 2,
                    'conditions' => array
                        (
                        'Message.id' => $id
                    )
                        )
                ));
        $this->set('id', $id);
        $this->render('Details');
    }

    public function respond() {

        if ($this->request->is('post') or $this->request->is('put')) {

            $this->request->data['MessageContent']['message_id'] = $this->request->data['Message']['id'];
            $this->request->data['MessageContent']['sender_id'] = 1; //@TODO: trocar o 1


            if ($this->MessageContent->save($this->request->data)) {

                //@TODO: trocar o 1 pelo condigo do usuário
                if ($this->request->data['Message']['sender_id'] == 1) {

                    $this->MessageContent->query("
                    update messages set sender_status = 'Enviada', receiver_status = 'Nova Mensagem' where id = " . $this->request->data['Message']['id'] . ";
                ");

                    $this->Session->setFlash('Mensagem respondida.', 'message-success');

                    //@TODO: trocar o 1
                } else if ($this->request->data['Message']['receiver_id'] == 1) {

                    $this->MessageContent->query("
                    update messages set sender_status = 'Nova Mensagem', receiver_status = 'Enviada' where id = " . $this->request->data['Message']['id'] . ";
                ");

                    $this->Session->setFlash('Mensagem respondida.', 'message-success');

                }

            } else {
                $this->Session->setFlash('Ocorreu um erro ao responder, tente novamente.', 'message-error');
            }
        }
        $this->redirect(array('action' => 'index'));
    }

    public function index_novas() {
        $this->set('controller_name', 'Mensagens');
        $this->set('controller_action', 'Listar');



        $this->set('messages', $this->paginate('Message', array('Message.sender_status' => 'Nova Mensagem')));
        $this->render('Index');
    }

    //@TODO: trocar o 1
    function list_colaboradores() {
        $this->layout = false;

        $this->set('colaboradores', $this->Entity->query(
                        'select name from entities where id <> 1 order by name;'
                ));
    }

}
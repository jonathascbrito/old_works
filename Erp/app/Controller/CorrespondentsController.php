<?php

App::uses('AppController', 'Controller');

class CorrespondentsController extends AppController {

    public $name = 'Correspondents';
    public $uses = array
        (
        'Entity',
        'Correspondent',
        'CorrespondentFee',
        'CorrespondentSecundaryData',
        'User'

    );

    public $paginate = array
        (
        'limit' => 25,
        'order' => array
            (
            'id' => 'desc'
        )
    );

    public function index() {
        $this->set('controller_name', 'Correspondentes');
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

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('correspondents', $this->paginate('Correspondent'));
        $this->render('Index');
    }

    public function add() {
        $this->set('controller_name', 'Correspondentes');
        $this->set('controller_action', 'Adicionar');

        if ($this->request->is('post') or $this->request->is('put')) {

            var_dump($this->request->data);
            parent::save(
                    "Correspondent", "Ato salvo com sucesso!", "Houve um problema ao salvar!"
            );
        }

        $this->setResources();
        $this->render('form');
    }

    public function admin() {

        $this->set('controller_name', 'Correspondentes');
        $this->set('controller_action', 'Adicionar');


        $this->set('entities_partner', $this->Entity->find
                        (
                        "list", array
                    (
                    "conditions" => array('partner' => '1'),
                    "order" => array('Entity.name asc')
                        )
                )
        );

        $this->set('entities_client', $this->Entity->find
                        (
                        "list", array
                    (
                    "conditions" => array('client' => '1'),
                    "order" => array('Entity.name asc')
                        )
                )
        );

        if ($this->request->is('post') or $this->request->is('put')) {

            var_dump($this->request->data);
            parent::save(
                    "Correspondent", "Ato salvo com sucesso!", "Houve um problema ao salvar!"
            );
        }

        //$this->setResources();
        $this->render('admin');
    }

}
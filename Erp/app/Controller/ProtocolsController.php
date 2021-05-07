<?php

App::uses('AppController', 'Controller');


class ProtocolsController extends AppController {


    public $name = 'Protocols';
    public $uses = array
        (
        'OrganizationalUnit',
        'Entity',
        'Protocol'
    );
    public $paginate = array
        (
        'limit' => 25,
        'order' => array
            (
            'id' => 'desc'
        )
    );

    public function gerarNumeroProtocolo() {


        $numeronovo = date('Y') . "/";
        $numeroatual = $this->Protocol->query("select number from protocols where id = (select max(id) from protocols);");


        if (empty($numeroatual)) {
            $numeronovo.= str_pad(1, 7, "0", STR_PAD_LEFT);
        } else if (substr($numeroatual[0]['protocols']['number'], 0, 4) < date("Y")) {
            $numeronovo = date('Y') . "/";
            $numeronovo.= str_pad(1, 7, "0", STR_PAD_LEFT);
        } else {

            $numeronovo.= str_pad((int) substr($numeroatual[0]['protocols']['number'], 5) + 1, 7, "0", STR_PAD_LEFT);
        }

        return $numeronovo;
    }

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

        $this->set('departments', $this->OrganizationalUnit->find
                        (
                        "list", array
                    (
                    "recursive" => 1,
                    "fields" => array('OrganizationalUnit.id', 'OrganizationalUnit.qualified_name'),
                    "order" => array('OrganizationalUnit.code asc')
                        )
                )
        );
    }

    public function view($id) {
        $this->set('controller_name', 'Protocolos');
        $this->set('controller_action', 'Detalhes');

        $this->Protocol->id = $id;
        $this->set('protocol', $this->Protocol->read());

        $this->render('Details');
    }

    public function index() {
        $this->set('controller_name', 'Protocolos');
        $this->set('controller_action', 'Listar');


        $user = $this->Session->read('User');
        $this->set('protocols', $this->paginate('Protocol', array('or' => array('Protocol.entity_id' => $user['Entity']['id'], 'Protocol.response_receiving_id' => $user['Entity']['id']))));
        $this->render('Index');
    }

    public function index_enviados() {
        $this->set('controller_name', 'Protocolos');
        $this->set('controller_action', 'Listar');


        $user = $this->Session->read('User');
        $this->set('protocols', $this->paginate('Protocol', array('Protocol.entity_id' => $user['Entity']['id'])));
        $this->render('Index');
    }

    public function index_recebidos() {
        $this->set('controller_name', 'Protocolos');
        $this->set('controller_action', 'Listar');

        $user = $this->Session->read('User');
        $this->set('protocols', $this->paginate('Protocol', array('Protocol.response_receiving_id' => $user['Entity']['id'])));
        $this->render('Index');
    }

    //Adiciona uma nova solicitação
    public function add() {
        $this->set('controller_name', 'Protocolos');
        $this->set('controller_action', 'Adicionar');

        if ($this->request->is('post') or $this->request->is('put')) {

            $user = $this->Session->read('User');

            $this->request->data['Protocol']['number'] = $this->gerarNumeroProtocolo();

            $this->request->data['Protocol']['status'] = "Aberto";
            $this->request->data['Protocol']['entity_id'] = $user['Entity']['id'];
            $this->request->data['Protocol']['create_date'] = date('Y/m/d');

            if ($this->request->data['Protocol']['priority'] == "B") {
                $this->request->data['Protocol']['prevision_date'] = date('Y-m-d', time() + Configure::read('Mvtl.Protocols.LowPriority') * 60 * 60 * 24);
            } else if ($this->request->data['Protocol']['priority'] == "N") {
                $this->request->data['Protocol']['prevision_date'] = date('Y-m-d', time() + Configure::read('Mvtl.Protocols.NormalPriority') * 60 * 60 * 24);
            } else {
                $this->request->data['Protocol']['prevision_date'] = date('Y-m-d', time() + Configure::read('Mvtl.Protocols.HighPriority') * 60 * 60 * 24);
            }

            $this->request->data['Protocol']['logistic_response_id'] = "";

            if ($this->request->data['Protocol']['type'] == "Externo") {


                $logistica_id = $this->Entity->query(
                        "
                                select id from entities where name = '" . $this->request->data['Protocol']['logistic_response_nome'] . "';
                            "
                );


                $this->request->data['Protocol']['logistic_response_id'] = $logistica_id[0]['entities']['id'];
            }/* else {
                $departamento_responsavel_id = $this->Department->query(
                        "
                                select response_name_id from departments where id = ".$this->request->data['Protocol']['department_id_receiving'].";
                            "
                );



                $this->request->data['Protocol']['response_receiving_id'] = $departamento_responsavel_id[0]['departments']['response_name_id'];

            }*/

            parent::save(
                    "Protocol", "Novo protocolo salvo com sucesso!", "Houve um problema ao salvar o protocolo!"
            );

        }



        $this->setResources();
        $this->render('form');
    }


    //Destinatário informa o recebimento da solicitação e status do protocolo é atualizado.
    public function edit_receiving($id) {
        $this->set('controller_name', 'Protocolos');
        $this->set('controller_action', 'Informar recebimento');

        $this->Protocol->id = $id;
        $this->set('protocol', $this->Protocol->read());

        if ($this->request->is('post') or $this->request->is('put')) {
            $this->Protocol->id = $id;
            $this->Protocol->saveField('status', 'Em Andamento');

            $this->Session->setFlash('Protocolo recebido com sucesso. Status alterado para "Em Andamento".', 'message-success');
            $this->redirect(array('action' => 'index'));
        }

        $this->set('id', $id);
        $this->render('Edit_receiving');
    }

    //Finaliza o protocolo atualizando Status e data de finalização
    public function edit_finaliza($id) {
        $this->set('controller_name', 'Protocolos');
        $this->set('controller_action', 'Finalizar Solicitação');

        $this->Protocol->id = $id;
        $this->set('protocol', $this->Protocol->read());

        if ($this->request->is('post') or $this->request->is('put')) {
            $this->Protocol->id = $id;
            $this->Protocol->saveField('status', 'Finalizado!');

            $this->Session->setFlash('Protocolo finalizado com sucesso. Status alterado para "Finalizado".', 'message-success');
            $this->redirect(array('action' => 'index'));
        }

        $this->set('id', $id);
        $this->render('Edit_finalizado');
    }

    //Destinatário do protocolo informa realização da solicitação e preenche campo de observação.
    public function complete_receiving($id) {
        $this->set('controller_name', 'Protocolos');
        $this->set('controller_action', 'Atualizar Solicitação');

        $this->Protocol->id = $id;
        $this->set('protocol', $this->Protocol->read());

        if ($this->request->is('post') or $this->request->is('put')) {
            $this->Protocol->id = $id;
            $this->Protocol->updateAll(
                    array(
                        'Protocol.status' => "'Finalizar'" ,
                        'Protocol.notice' => "'".$this->request->data['Protocol']['notice']."'",
                        'Protocol.return_date' => "'".date('Y/m/d')."'"
                   ),
                    array('Protocol.id' => $id)
                    );


            $this->Session->setFlash('Protocolo atualizado. Aguardando finalização pelo solicitante.', 'message-success');
            $this->redirect(array('action' => 'index'));
        }

        $this->set('id', $id);
        $this->render('Complete_receiving');
    }

    function list_names() {
        $this->layout = false;

        $this->set('destinatarios', $this->Protocol->query(
                        "select distinct response_receiving_name from protocols
                            where response_receiving_name is not null
            order by response_receiving_name
            ;"
                ));
    }

    function list_colaboradores() {
        $this->layout = false;

        $this->set('colaboradores', $this->Entity->query(
                        'select name from entities order by name;'
                ));
    }

}

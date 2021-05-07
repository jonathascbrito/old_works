<?php
App::uses('AppController', 'Controller');

class TicketsController extends AppController
{

    public $name = 'Tickets';
    public $uses = array
    (
        'Entity',
        'Device',
        'Computer',
        'Problem',
        'OrganizationalUnit',
        'Ticket',
        'TicketAnswer',
        'TicketRating'
    );

    public $paginate = array
    (
        'limit' => 25,
        'order' => array
        (
            'number' => 'desc'
        )
    );
    


    /*
    *
    * View: Visualização do ticket, sem poder realizar nenhuma modificação
    *
    */
    public function view($id) {

        $this->set('controller_name', 'Tickets');
        $this->set('controller_action', 'Detalhes');


        $this->set('entities', $this->Entity->find
                        (
                        "list", array
                    (
                    "conditions" => array('employee' => '1'),
                    "order" => array('Entity.name asc')
                        )
                )
        );

        $this->set('computer', $this->Computer->find
                (
                        "list", array
                    (
                    "fields" => array('Computer.id', 'Computer.name'),
                    "order" => array('Computer.name asc')
                        )
                )
        );
        
        $this->set('device', $this->Device->find
                (
                        "list", array
                    (
                    "fields" => array('Device.id', 'Device.name'),
                    "order" => array('Device.name asc')
                        )
                )
        );


        $this->set('problem', $this->Problem->find
                (
                        "list", array
                    (
                    "fields" => array('Problem.id', 'Problem.problem'),
                    "order" => array('Problem.problem asc')
                        )
                )
        );

        $this->Ticket->id = $id;
        $this->set('ticket', $this->Ticket->read());


        $this->render('Details');



        //@TODO: trocar o 1 colocar dados do usuário que realizou a resposta

        //$this->request->data['Ticket']['sender_id'] = 1;


    }


    /*
     *
     * Admin: Área para administração do ticket, sendo ele help desk ou administrador
     *
     */

    public function admin($id) {

        $this->set('controller_name', 'Tickets');
        $this->set('controller_action', 'Administrar');

        $this->set('entities', $this->Entity->find
                        (
                        "list", array
                    (
                    "conditions" => array('employee' => '1'),
                    "order" => array('Entity.name asc')
                        )
                )
        );

        $this->set('computer', $this->Computer->find
                (
                        "list", array
                    (
                    "fields" => array('Computer.id', 'Computer.code'),
                    "order" => array('Computer.name asc')
                        )
                )
        );
        
        $this->set('device', $this->Device->find
                (
                        "list", array
                    (
                    "fields" => array('Device.id', 'Device.name'),
                    "order" => array('Device.name asc')
                        )
                )
        );


        $this->set('problem', $this->Problem->find
                (
                        "list", array
                    (
                    "fields" => array('Problem.id', 'Problem.problem'),
                    "order" => array('Problem.problem asc')
                        )
                )
        );


        $this->Ticket->id = $id;
        $this->set('ticket', $this->Ticket->read());


        /*
         * Quando a aquipe abrir o ticket pela primeira vez (status aberto),
         * sistema altera automaticamente para status em andamento
         */

        
        if($this->Ticket->status == "Aberto"){
            $this->Ticket->query("update tickets set status = 'Em Análise' where id = " . $this->Ticket->id . ";
            ");
        }

        $this->render('Admin');


        /*
        * Salvando as informações registradas pelo Administrador,
        */

        if ($this->request->is('post') or $this->request->is('put')) {


            $this->request->data['TicketAnswer']['ticket_id'] = $this->request->data['Ticket']['id'];
            
            //@TODO: trocar o 1 pelo id do Admin
            
            $this->request->data['TicketAnswer']['sender_id'] = 1;


            // Fechando o Ticket
            
            if($this->request->data['Ticket']['status'] == 'Fechado'){
                
                if ($this->Ticket->save($this->request->data)) {
                    
                    $this->Session->setFlash('Ticket Fechado com sucesso.', 'message-success');
                    $this->redirect(array('action' => 'index'));

                } else {

                    $this->Session->setFlash('Ocorreu um erro ao fechar o ticket, tente novamente.', 'message-error');
                    $this->redirect(array('action' => 'index'));
                }

            } else {

                if($this->Ticket->save($this->request->data)){

                    //@TODO: Verificar se trata-se do perfil de administrador ou Help Desk para substituir 1

                    if($this->request->data['TicketAnswer']['sender_id'] == 1){

                        if($this->TicketAnswer->save($this->request->data)) {
                            
                            //Enviando msg para o usuário
                            
                            $this->TicketAnswer->query("update tickets set messenge_status = 'Aguardando Usuário', status = 'Em Andamento' where id = " . $this->request->data['Ticket']['id'] . ";");
                            $this->Session->setFlash('Resposta encaminhada com sucesso.', 'message-success');

                        } else {

                            $this->Session->setFlash('Ocorreu um erro ao responder o ticket, tente novamente.', 'message-error');
                            $this->redirect(array('action' => 'index'));
                        }

                    }

                }

            }
        }

    }


    /*
     * Add: Adicionando novo ticket.
     *
     */
    
    public function add() {

        $this->set('controller_name', 'Tickets');
        $this->set('controller_action', 'Adicionar');

        $this->set('entities', $this->Entity->find
                        (
                        "list", array
                    (
                    "conditions" => array('employee' => '1'),
                    "order" => array('Entity.name asc')
                        )
                )
        );

        $this->set('computer', $this->Computer->find
                (
                        "list", array
                    (
                    "fields" => array('Computer.id', 'Computer.name'),
                    "order" => array('Computer.name asc')
                        )
                )
        );
        
        
        $this->set('device', $this->Device->find
                (
                        "list", array
                    (
                    "fields" => array('Device.id', 'Device.name'),
                    "order" => array('Device.name asc')
                        )
                )
        );


        $this->set('problem', $this->Problem->find
                (
                        "list", array
                    (
                    "fields" => array('Problem.id', 'Problem.problem'),
                    "order" => array('Problem.problem asc')
                        )
                )
        );


        if ($this->request->is('post') or $this->request->is('put')) {

            /*
             * Gerando o número do ticket
             * 
             */

            $number = '00000';
            $lastnumber = $this->Ticket->field("number", array('1'=>'1'), 'id DESC');

            if (preg_match('|^(?<year>[0-9]*)\/(?<number>[0-9]+)$|siU', $lastnumber, $match)){
                $year = $match['year']; $number = $match['number'];

                if ((int) $year < (int) date('Y')){
                    $number = '00000';
                }
            }

            $number = date('Y') . '/' . str_pad((int) $number+1, 5, '0', STR_PAD_LEFT);


            $this->request->data['Ticket']['number'] = $number;
            
            /*
             * Quando é enviado o ticket ele automaticamente recebe status aberto
             */
            $this->request->data['Ticket']['status'] = "Aberto";

            parent::save
            (
                "Ticket",
                "Novo ticket foi enviado com sucesso!",
                "Ocorreu um problema ao encaminhar o ticket!"
            );

        }

        $this->render('form');


    }

    /*
     * Edit: Página para que o ticket seja editado alguns campos pelo usuário
     * que o abriu, ou enviar uma resposta
     * 
     * 
     */

    public function edit ( $id ) {

        $this->set('controller_name', 'Tickets');
        $this->set('controller_action', 'Editar ou Responder');
        
        $this->set('entities', $this->Entity->find
                        (
                        "list", array
                    (
                    "conditions" => array('employee' => '1'),
                    "order" => array('Entity.name asc')
                        )
                )
        );

        $this->set('computer', $this->Computer->find
                (
                        "list", array
                    (
                    "fields" => array('Computer.id', 'Computer.name'),
                    "order" => array('Computer.name asc')
                        )
                )
        );
        
        
        $this->set('device', $this->Device->find
                (
                        "list", array
                    (
                    "fields" => array('Device.id', 'Device.name'),
                    "order" => array('Device.name asc')
                        )
                )
        );


        $this->set('problem', $this->Problem->find
                (
                        "list", array
                    (
                    "fields" => array('Problem.id', 'Problem.problem'),
                    "order" => array('Problem.problem asc')
                        )
                )
        );
        
        $this->set('ticketanswers', $this->TicketAnswer->find
                (
                        "list", array
                    (
                    "conditions" => array('TicketAnswer.ticket_id' => $id),
                    "fields" => array('TicketAnswer.id', 'TicketAnswer.answer'),
                    "order" => array('TicketAnswer.id asc')
                        )
                )
        );

        $ticket = $this->Ticket->read(null, $id);
        $this->set('ticket', $ticket);


        /*
         * Ticket somente com status aberto poderá ser editado
         */
        
        if($ticket['Ticket']['status'] == 'Aberto'){

            if ( $this->request->is('post') or $this->request->is('put') ){

                $this->Ticket->recursive = 0;
                $ticket = $this->Ticket->read(null, $id);
                $this->request->data['Ticket'] = $ticket['Ticket'];

                unset($this->request->data['Ticket']['closing_observation']);

                $this->request->data['TicketAnswer']['ticket_id'] = $id;
                
                //@TODO: Verificar o id de quem está enviando a mensagem
                
                $this->request->data['TicketAnswer']['sender_id'] = 1;

                parent::save
                (
                    "TicketAnswer",
                    "Ticket editado com sucesso!",
                    "Houve um problema em encaminhar o ticket!"
                );

                //var_dump($this->TicketAnswer->invalidFields());
            }else{

                $this->Ticket->id = $id;
                $this->request->data = $this->Ticket->read();

            }

            $this->set( 'id', $id );
            $this->render('Edit');
        
        } else {
            
            if($ticket['Ticket']['status'] == 'Fechado' || $ticket['Ticket']['status'] == 'Fechado - Indevido'){

                $this->Session->setFlash('Esse ticket já foi fechado e não pode ser editado.', 'message-error');
                $this->redirect(array('action' => 'index'));
            } else {
                
                $this->Session->setFlash('Esse ticket se encontra em andamento e não pode ser editado.', 'message-error');
                $this->redirect(array('action' => 'index'));    
                
            }
            
        }
    }

    /*
     * Index: Listagem dos tickets
     *
     */

    public function index ( )
    {
        $this->set( 'controller_name', 'Tickets' );
        $this->set( 'controller_action', 'Listar' );

        if ( isset($this->request->data['filter']['terms']) ) :
            $terms = $this->request->data['filter']['terms'];

            $this->paginate[ 'conditions' ] = array
            (
                "or" => array
                (
                    "Ticket.number LIKE" => "%{$terms}%",
                    "Ticket.status LIKE" => "%{$terms}%",
                    "Ticket.priority LIKE" => "%{$terms}%",
                    "Ticket.type LIKE" => "%{$terms}%"
                )
            );
        endif;

        $this->set('terms', isset($terms) ? $terms : false );
        $this->set('tickets', $this->paginate('Ticket'));
        $this->render('Index');
    }

    /*
    * Rating: Página para avaliação do retorno do help desk, somente usuários
    *usuários terão acesso a essa página
    */

    public function rating ( $id ) {

        $this->set('controller_name', 'Tickets');
        $this->set('controller_action', 'Avaliar Atendimento');

        $ticket = $this->Ticket->read(null, $id);
        $this->set('ticket', $ticket);

        if ( $this->request->is('post') or $this->request->is('put') ){

            $this->Ticket->recursive = 0;
            $ticket = $this->Ticket->read(null, $id);
            $this->request->data['Ticket'] = $ticket['Ticket'];


            $this->request->data['Ticket']['rating'] = true;

            parent::save
            (
                "TicketRating",
                "Avaliação do Ticket enviado com sucesso!",
                "Houve um problema ao enviar a avaliação!"
            );


        }else{
            $this->Ticket->id = $id;
            $this->request->data = $this->Ticket->read();
        }

        $this->set( 'id', $id );
        $this->render('TicketRating');
    }


    /*
     * Delete: Apagar, podemos retirar ou não
     */


    public function delete ( $id )
    {
        $this->Ticket->delete( $id );
        $this->Session->setFlash('O ticket foi deletado com sucesso.', 'message-error');
        $this->redirect( array( 'action' => 'index' ) );
    }





}
<?php

/**
 * ModuleHelpdeskController
 *
 * Controlador responsável pelo sistema de helpdesk. Permite gerenciar os
 * chamados recebidos e enviados.
 */
class ModuleHelpdeskController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'Ticket',
        'TicketType',
        'System',
        'Entity',
        'Message',
        'Test'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'Ticket.code_year' => 'desc',
            'Ticket.code_number' => 'desc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Tickets';
    public $bundle = 'ModulesHelpdesk';

    /**
     * Lista os tickets do sistema.
     * @controller-action
     */
    public function index() {
        $this->Ticket->recursive = 1;

        $this->setSearch('Ticket', array(
            'cliente'=> 'Entity.name',
            'tipo'       => 'Type.name',
            'status'     => 'Ticket.status'
        ));

		if ( ! $this->hasPermission('ModuleHelpdesk answer')) {
			$this->paginate['conditions']['and'] = array(
				'Ticket.user_id' => $this->Auth->user('id')
			);
		}
		
        $this->set('title', 'Módulos > Ordens de Serviço');
        $this->set('tickets', $this->paginate('Ticket'));
    }

    /**
     * Método responsável por exibir detalhes sobre um protocolo previamente
     * cadastrado no sistema.
     * @controller-action
     */
    public function view($id) {
        $this->isAjaxRequest(true);

        $this->Ticket->id = $id;
        $this->Ticket->recursive = 1;

        $ticket = $this->Ticket->read(null, $id);

        if ( ! $ticket) {
            throw new NotFoundException();
        }

        $this->set('ticket', $ticket);
    }

    /**
     * Método responsável por criar um novo protocolo. Exibe um formulário ou
     * uma mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            
            if ($this->request->data['Ticket']['user_id'] == '') {
                $this->request->data['Ticket']['user_id'] = $this->Auth->user('id');
            }

            $this->request->data['Ticket']['status'] = 'Aberto';

            if ($this->Ticket->saveAll($this->request->data)) {
                $this->set('success', true);
               
                $this->Message->set(
                        array(
                            'to' => $this->request->data['Ticket']['user_id'],
                            'from' => $this->Auth->user('id'),
                            'subject' => 'Aberta nova O.S.',
                            'content' => 'Foi aberto nova Ordem de Serviço para seu atendimento para '.$this->request->data['Ticket']['service_date'].' às '.$this->request->data['Ticket']['service_time'].' para maiores informações acesse a área de Chamados.'
                        )
                );
                $this->Message->save();
                
            }
            

            if (isset($this->Ticket->validationErrors['user_id'])) {
                $this->Ticket->validationErrors['user_id_name'] = $this->Ticket->validationErrors['user_id'];
            }

            /*if (isset($this->Ticket->validationErrors['ticket_type_id'])) {
                $this->Ticket->validationErrors['ticket_type_id_name'] = $this->Ticket->validationErrors['ticket_type_id'];
            }

            if (isset($this->Ticket->validationErrors['ticket_device_id'])) {
                $this->Ticket->validationErrors['ticket_device_id_name'] = $this->Ticket->validationErrors['ticket_device_id'];
            }*/
        }
        
        $this->set('systems', $this->System->find('list'));
        
    }
    
    
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('get')) {
            $this->Ticket->id = $id;
            $this->Ticket->recursive = 1;

            $ticket = $this->Ticket->read(null, $id);

            if ( ! $ticket) {
                throw new NotFoundException();
            }

            $this->request->data = $ticket;
            $this->set('ticket', $ticket);
            $this->set('tests', $this->Test->find('list'));
        }

        if ($this->isMethod('put')) {
            
            $this->Ticket->id = $id;
            $this->Ticket->recursive = 1;
            
            $ticket = $this->Ticket->read(null, $id);
            
            
            if ($this->Ticket->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
    }
    

    /**
     * Método responsável por popular as sugestões do campo user.
     * @controller-action
     */
    public function users() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->User->find('list', array(
            'conditions' => array(
                'User.name like' => '%' . $q . '%'
            )
        )));
    }
    /**
     * Método responsável por gerar um pdf do chamado aberto.
     * @controller-action
     */
    public function pdf_create($id) {
        
        
    App::import('Vendor', 'fpdf', array('file' => 'fpdf/fpdf.php'));
    
        $this->Ticket->id = $id;
        $this->Ticket->recursive = 1;

        $ticket = $this->Ticket->read(null, $id);

        $this->Entity->recursive = 1;
        $entity = $this->Entity->read(null, $ticket['Entity']['id']);
        
        
        if ( ! $ticket) {
            throw new NotFoundException();
        }

        
$sistemas = array(
                    'Sprinklers',
                    'Hidrantes', 
                    'Detecção Chama/Gás',
                    'Espuma',
                    'Water Spray',
                    'Analaser',
                    'Detecção Convencional',
                    'APC',
                    'CO²',
                    'Detecção Inteligente',
                );

$teste = '';
foreach($entity['Systems'] as $sistema){
    $teste .= '/'.$sistema['name'];
 
}
$system = explode('/', $teste);

$nome = $ticket['Entity']['name'];
$contato = $ticket['Entity']['contact'];
$email = $ticket['Entity']['email'];
$endereco = $ticket['Entity']['address'];
$cellphone = $ticket['Entity']['cellphone'];
$phone = $ticket['Entity']['phone'];
$data = $ticket['Ticket']['service_date'];
$horario = $ticket['Ticket']['service_time'];
$tecnico = $ticket['User']['name'];
//$observacoes = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis fri";

$number = $ticket['Ticket']['code_number']."/".$ticket['Ticket']['code_year'];

$pdf= new FPDF("P","pt","A4");
 
 
$pdf->AddPage();
$pdf->Image(WWW_ROOT . '/img/logo-cardim4.png', null, null, 0, 0);
 
$pdf->SetFont('arial','B',14);
$pdf->Cell(0,-20,utf8_decode("O.S. Nº: ").$number,0,0,'R');
$pdf->Rect(430,47,137,30,'D');
$pdf->Ln(8);
 
 
//Rect(float x, float y, float w, float h [, string style])
//$pdf->Rect(0,0,30,30,'DF');



$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode('Empresa:'),'LT',0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,utf8_decode($nome),'RT',1,'L');
 
//cep
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode('Contato:'),'L',0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,utf8_decode($contato),'R',1,'L');


//email
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode('Email:'),'L',0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,utf8_decode($email),'R',1,'L');

//Endereço
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode('Endereço:'),'L',0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,utf8_decode($endereco),'R',1,'L');
 
//Data e Horário
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode('Data e Horário:'),'L',0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,utf8_decode($data.' - '.$horario),'R',1,'L');
 
//Telefone
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode('Telefone:'),'L',0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,utf8_decode($phone),'R',1,'L');

//Celular
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode('Celular:'),'L',0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,utf8_decode($cellphone),'R',1,'L');

//Técnico Responsável
$pdf->SetFont('arial','B',12);
$pdf->Cell(120,20,utf8_decode('Tec. Responsável:'),'LB',0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,utf8_decode($tecnico),'RB',1,'L');

//nome cell(w, h, txt, border, position, alinhamento, fill, link) 
//Equipamentos Cell(120,20,"Empresa:",'LT',0,'L');
$pdf->SetFont('arial','B',16);
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Cell(0,20,utf8_decode('Equipamentos:'),'LR',1,'L');
$pdf->Cell(0,3,"","LR",1,'C');

$pdf->SetFont('arial','B',12);
$pdf->Cell(270,20,utf8_decode('Sprinklers'),'LR','C');
$pdf->Cell(0,20,utf8_decode('Hidrantes'),'LR',1,'L');
$pdf->Cell(270,20,utf8_decode('Detecção Chama/Gás'),'LR','C');
$pdf->Cell(0,20,utf8_decode('Espuma'),'LR',1,'L');
$pdf->Cell(270,20,utf8_decode('Water Spray'),'LR','C');
$pdf->Cell(0,20,utf8_decode('Analaser'),'LR',1,'L');
$pdf->Cell(270,20,utf8_decode('Detecção Convencional'),'LR','C');
$pdf->Cell(0,20,utf8_decode('APC'),'LR',1,'L');
$pdf->Cell(270,20,utf8_decode('CO²'),'LR','C');
$pdf->Cell(0,20,utf8_decode('Detecção Inteligente'),'LR',1,'L');
$pdf->Cell(0,5,"",'LR',1,'C');
$pdf->Cell(0,20,utf8_decode('Outros: '),"LRB",1,'L');

//Retangulos Marcadores Equipamentos

$x = 1;
$y = 276;
foreach($sistemas as $sistema){
    
    
    if(in_array($sistema, $system)){
       if($x%2 != 0){
         $pdf->Rect(280,$y,10,10,'DF');  
       } else {
         $pdf->Rect(547,$y,10,10,'DF');
         $y += 20;
       }
    } else {
        if($x%2 != 0){
         $pdf->Rect(280,$y,10,10,'D');  
       } else {
         $pdf->Rect(547,$y,10,10,'D');
         $y += 20;
       }
    }
    $x++;
    
}

//$pdf->Rect(280,276,10,10,'D');
//$pdf->Rect(547,276,10,10,'D');
//$pdf->Rect(280,296,10,10,'D');
//$pdf->Rect(547,296,10,10,'D');
//$pdf->Rect(280,316,10,10,'D');
//$pdf->Rect(547,316,10,10,'D');
//$pdf->Rect(280,336,10,10,'D');
//$pdf->Rect(547,336,10,10,'D');
//$pdf->Rect(280,356,10,10,'D');
//$pdf->Rect(547,356,10,10,'D');

//Testes Realizados
$pdf->SetFont('arial','B',16);
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Cell(0,20,utf8_decode('Testes Realizados: '),'LR',1,'L');
$pdf->Cell(0,3,"","LR",1,'C');

$pdf->SetFont('arial','B',12);
$pdf->Cell(185,20,utf8_decode("Alarme de incêndio"),'LR','C');
$pdf->Cell(185,20,utf8_decode("Avaria"),'LR',0,'L');
$pdf->Cell(0,20,utf8_decode("Falta AC"),'LR',1,'L');
$pdf->Cell(185,20,utf8_decode("Falta DC"),'LR',0,'L');
$pdf->Cell(185,20,utf8_decode("Tensão Bateria"),'LR',0,'L');
$pdf->Cell(0,20,utf8_decode("Aterramento"),'LR',1,'L');
$pdf->Cell(185,20,utf8_decode("Sirenes"),'LR',0,'L');
$pdf->Cell(185,20,utf8_decode("Acionadores"),'LR',0,'L');
$pdf->Cell(0,20,utf8_decode("Detectores"),'LR',1,'L');
$pdf->Cell(0,5,"",'LR',1,'C');
$pdf->Cell(0,20,utf8_decode('Outros: '),"LRB",1,'L');

//Retangulos para serem marcados nos testes realizados
$pdf->Rect(196,426,10,10,'D');
$pdf->Rect(380,426,10,10,'D');
$pdf->Rect(550,426,10,10,'D');

$pdf->Rect(196,446,10,10,'D');
$pdf->Rect(380,446,10,10,'D');
$pdf->Rect(550,446,10,10,'D');

$pdf->Rect(196,466,10,10,'D');
$pdf->Rect(380,466,10,10,'D');
$pdf->Rect(550,466,10,10,'D');

//Serviços Executados
$pdf->SetFont('arial','B',12);
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Cell(0,20,utf8_decode("Descrição Serviço Executado: "),'LRT',1,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,70,'','LRB',1);

//Horário do Serviço
$pdf->SetFont('arial','B',16);
$pdf->Cell(0,5,"","B",1,'C');
$pdf->SetFont('arial','B',12);
$pdf->Cell(270,20,utf8_decode("Horário Inicio: "),'LRB','C');
$pdf->Cell(0,20,utf8_decode("Horário Fim: "),'LRB',1,'L');

 //$pdf->Cell(0,20,"Detectores",'LR',1,'L');
//$pdf->ln(10);
//Observações
$pdf->SetFont('arial','B',12);
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Cell(0,20,utf8_decode("Observações: "),'LRT',1,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,70,'','LRB',1);


//Responsável e Assinatura Carimbo
$pdf->SetFont('arial','B',12);
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Cell(270,20,utf8_decode("Responsável: "),'LR','C');
$pdf->Cell(0,20,utf8_decode("Carimbo/Assinatura: "),'LR',1,'L');
$pdf->Cell(270,30,"",'LRB','C');
$pdf->Cell(0,30,"",'LRB',1,'L');
 
$pdf->Output("arquivo.pdf","D");




    }
    
   
    /**
     * Método responsável por popular as sugestões do campo type.
     * @controller-action
     */
    public function types() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        echo json_encode($this->TicketType->find('list', array(
            'conditions' => array(
                'TicketType.name like' => '%' . $q . '%'
            )
        )));
    }
    /**
     * Método responsável por popular as sugestões do campo device.
     * @controller-action
     */
    public function entities() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        if (empty($q)) {
            echo json_encode(array());
            return;
        }

        echo json_encode($this->Entity->find('list', array(
            'conditions' => array(
                'Entity.name like' => '%' . $q . '%'
            )
        )));
    }
    
    /**
     * Método responsável por popular as sugestões do campo device.
     * @controller-action
     */
    /*public function systems() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';

        echo json_encode($this->System->find('list', array(
            'fields' => array(
                'System.id',
                'System.qualified_name'
            ),
            'conditions' => array(
                'or' => array(
                    'System.name like' => '%' . $q . '%'
                )
            )
        )));
    }*/

}

?>
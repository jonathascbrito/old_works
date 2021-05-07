<?php

/**
 * SettingsBanksAccountsController
 *
 * Controlador responsável pela configuração das contas bancárias do sistema.
 */
class SettingsBanksAccountsController extends AppController
{

    /**
     * Define os modelos utilizados pelo controlador.
     * @var array
     */
    public $uses = array(
        'BankAccount'
    );

    /**
     * Configura os parâmetros da classe Paginator.
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
        'paramType' => 'querystring',
        'order' => array(
            'BankAccount.name' => 'asc'
        )
    );

    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'BanksAccounts';
    public $bundle = 'SettingsSystem';

    /**
     * Lista de bancos e respectivos códigos.
     * @var array
     */
    public static $banks = array(
        '001' => 'BANCO DO BRASIL S.A.',
        '003' => 'BANCO DA AMAZONIA S.A.',
        '004' => 'BANCO DO NORDESTE DO BRASIL S.A.',
        '019' => 'BANCO AZTECA DO BRASIL S.A.',
        '021' => 'BANESTES S.A. BANCO DO ESTADO DO ESPIRITO SANTO',
        '025' => 'BANCO ALFA S.A',
        '033' => 'BANCO SANTANDER BANESPA S.A.',
        '037' => 'BANCO DO ESTADO DO PARÁ S.A.',
        '040' => 'BANCO CARGILL S.A.',
        '041' => 'BANCO DO ESTADO DO RIO GRANDE DO SUL S.A.',
        '044' => 'BANCO BVA S.A.',
        '045' => 'BANCO OPPORTUNITY S.A.',
        '047' => 'BANCO DO ESTADO DE SERGIPE S.A.',
        '062' => 'HIPERCARD BANCO MÚLTIPLO S.A.',
        '063' => 'BANCO IBI S.A. - BANCO MÚLTIPLO',
        '065' => 'BANCO LEMON S.A.',
        '066' => 'BANCO MORGAN STANLEY S.A.',
        '069' => 'BPN BRASIL BANCO MÚLTIPLO S.A.',
        '070' => 'BRB - BANCO DE BRASILIA S.A.',
        '072' => 'BANCO RURAL MAIS S.A.',
        '073' => 'BB BANCO POPULAR DO BRASIL S.A.',
        '074' => 'BANCO J. SAFRA S.A.',
        '075' => 'BANCO CR2 S/A',
        '076' => 'BANCO KDB DO BRASIL S.A.',
        '077' => 'BANCO INTERMEDIUM S/A',
        '079' => 'JBS BANCO S/A',
        '081' => 'CONCÓRDIA BANCO S.A.',
        '096' => 'BANCO BM&F DE SERVIÇOS DE LIQUIDAÇÃO E CUSTÓDIA S.A.',
        '104' => 'CAIXA ECONOMICA FEDERAL',
        '107' => 'BANCO BBM S/A',
        '151' => 'BANCO NOSSA CAIXA S.A.',
        '208' => 'BANCO UBS PACTUAL S.A.',
        '212' => 'BANCO MATONE S.A.',
        '213' => 'BANCO ARBI S.A.',
        '214' => 'BANCO DIBENS S.A.',
        '217' => 'BANCO JOHN DEERE S.A.',
        '218' => 'BANCO BONSUCESSO S.A.',
        '222' => 'BANCO CALYON BRASIL S.A.',
        '224' => 'BANCO FIBRA S.A.',
        '225' => 'BANCO BRASCAN S.A.',
        '229' => 'BANCO CRUZEIRO DO SUL S.A.',
        '230' => 'UNICARD BANCO MÚLTIPLO S.A.',
        '233' => 'BANCO GE CAPITAL S.A.',
        '237' => 'BANCO BRADESCO S.A.',
        '241' => 'BANCO CLASSICO S.A.',
        '243' => 'BANCO MÁXIMA S.A.',
        '246' => 'BANCO ABC BRASIL S.A.',
        '248' => 'BANCO BOAVISTA INTERATLANTICO S.A.',
        '249' => 'BANCO INVESTCRED UNIBANCO S.A.',
        '250' => 'BANCO SCHAHIN S.A.',
        '254' => 'PARANÁ BANCO S.A.',
        '263' => 'BANCO CACIQUE S.A.',
        '265' => 'BANCO FATOR S.A.',
        '266' => 'BANCO CEDULA S.A.',
        '300' => 'BANCO DE LA NACION ARGENTINA',
        '318' => 'BANCO BMG S.A.',
        '341' => 'BANCO ITAÚ S.A.',
        '356' => 'BANCO ABN AMRO REAL S.A.',
        '366' => 'BANCO SOCIETE GENERALE BRASIL S.A.',
        '370' => 'BANCO WESTLB DO BRASIL S.A.',
        '376' => 'BANCO J.P. MORGAN S.A.',
        '389' => 'BANCO MERCANTIL DO BRASIL S.A.',
        '394' => 'BANCO FINASA BMC S.A.',
        '399' => 'HSBC BANK BRASIL S.A. - BANCO MULTIPLO',
        '409' => 'UNIBANCO-UNIAO DE BANCOS BRASILEIROS S.A.',
        '412' => 'BANCO CAPITAL S.A.',
        '422' => 'BANCO SAFRA S.A.',
        '453' => 'BANCO RURAL S.A.',
        '456' => 'BANCO DE TOKYO-MITSUBISHI UFJ BRASIL S/A',
        '464' => 'BANCO SUMITOMO MITSUI BRASILEIRO S.A.',
        '477' => 'CITIBANK N.A.',
        '487' => 'DEUTSCHE BANK S.A. - BANCO ALEMAO',
        '488' => 'JPMORGAN CHASE BANK, NATIONAL ASSOCIATION',
        '492' => 'ING BANK N.V.',
        '494' => 'BANCO DE LA REPUBLICA ORIENTAL DEL URUGUAY',
        '495' => 'BANCO DE LA PROVINCIA DE BUENOS AIRES',
        '505' => 'BANCO CREDIT SUISSE (BRASIL) S.A.',
        '600' => 'BANCO LUSO BRASILEIRO S.A.',
        '604' => 'BANCO INDUSTRIAL DO BRASIL S.A.',
        '610' => 'BANCO VR S.A.',
        '611' => 'BANCO PAULISTA S.A.',
        '612' => 'BANCO GUANABARA S.A.',
        '613' => 'BANCO PECUNIA S.A.',
        '623' => 'BANCO PANAMERICANO S.A.',
        '626' => 'BANCO FICSA S.A.',
        '630' => 'BANCO INTERCAP S.A.',
        '633' => 'BANCO RENDIMENTO S.A.',
        '634' => 'BANCO TRIANGULO S.A.',
        '637' => 'BANCO SOFISA S.A.',
        '638' => 'BANCO PROSPER S.A.',
        '643' => 'BANCO PINE S.A.',
        '653' => 'BANCO INDUSVAL S.A.',
        '654' => 'BANCO A.J. RENNER S.A.',
        '655' => 'BANCO VOTORANTIM S.A.',
        '707' => 'BANCO DAYCOVAL S.A.',
        '719' => 'BANIF - BANCO INTERNACIONAL DO FUNCHAL (BRASIL), S.A.',
        '721' => 'BANCO CREDIBEL S.A.',
        '734' => 'BANCO GERDAU S.A',
        '735' => 'BANCO POTTENCIAL S.A.',
        '738' => 'BANCO MORADA S.A.',
        '739' => 'BANCO BGN S.A.',
        '740' => 'BANCO BARCLAYS S.A.',
        '741' => 'BANCO RIBEIRAO PRETO S.A.',
        '743' => 'BANCO EMBLEMA S.A.',
        '745' => 'BANCO CITIBANK S.A.',
        '746' => 'BANCO MODAL S.A.',
        '747' => 'BANCO RABOBANK INTERNATIONAL BRASIL S.A.',
        '748' => 'BANCO COOPERATIVO SICREDI S.A.',
        '749' => 'BANCO SIMPLES S.A.',
        '751' => 'DRESDNER BANK BRASIL S.A. BANCO MULTIPLO',
        '752' => 'BANCO BNP PARIBAS BRASIL S.A.',
        '753' => 'NBC BANK BRASIL S. A. - BANCO MÚLTIPLO',
        '756' => 'BANCO COOPERATIVO DO BRASIL S.A. - BANCOOB',
        '757' => 'BANCO KEB DO BRASIL S.A.'
    );

    /**
     * Lista as contas bancárias do sistema.
     * @controller-action
     */
    public function index() {
        $this->setSearch('BankAccount', array(
            'nome'      => 'BankAccount.name',
            'banco'     => 'BankAccount.bank',
            'agência'   => 'BankAccount.agency',
            'conta'     => 'BankAccount.account'
        ));

        $this->set('title', 'Configurações > Contas Bancárias');
        $this->set('banksaccounts', $this->paginate('BankAccount'));
    }

    /**
     * Método responsável por criar uma nova conta bancária. Exibe um formulário
     * ou uma mensagem de confirmação.
     * @controller-action
     */
    public function create() {
        $this->isAjaxRequest(true);

        if ($this->isMethod('post')) {
            if ($this->BankAccount->saveAll($this->request->data)) {
                $this->set('success', true);
            }

            if (isset($this->BankAccount->validationErrors['bank'])) {
                $this->BankAccount->validationErrors['bank_name'] = $this->BankAccount->validationErrors['bank'];
            }
        }
    }

    /**
     * Método responsável por editar uma conta bancária já cadastrada. Exibe o
     * formulário preenchido com os dados do banco ou uma mensagem de confirmação.
     * @controller-action
     */
    public function update($id) {
        $this->isAjaxRequest(true);

        if ($this->isMethod('get')) {
            $this->BankAccount->id = $id;

            $bankaccount = $this->BankAccount->read(null, $id);

            if ( ! $bankaccount) {
                throw new NotFoundException();
            }

            $this->request->data = $bankaccount;
            $this->request->data['BankAccount']['bank_name'] = self::$banks[$this->request->data['BankAccount']['bank']];
        }

        if ($this->isMethod('put')) {
            if ($this->BankAccount->saveAll($this->request->data)) {
                $this->set('success', true);
            }
        }

        $this->set('id', $id);
    }

    /**
     * Método responsável por apagar uma conta bancária já cadastrada. Exibe um
     * alerta para confirmar a remoção ou uma mensagem de confirmação.
     * @controller-action
     */
    public function delete($id) {
        $this->isAjaxRequest(true);

        $bankaccount = $this->BankAccount->read(null, $id);

        if ( ! $bankaccount) {
            throw new NotFoundException();
        }

        $this->set('id', $id);
        $this->set('bankaccount', $bankaccount);

        if ($this->isMethod('delete')) {
            if ($this->BankAccount->delete($id)) {
                $this->set('success', true);
            }
        }
    }

    /**
     * Método responsável por popular as sugestões dos campos bank e code.
     * @controller-action
     */
    public function banks() {
        $this->autoRender = false;
        $this->isAjaxRequest(true);

        $q = isset($this->request->data['q']) ? $this->request->data['q'] : '';
        $q = mb_strtoupper($q);

        $results = array();
        $results_count = 0;

        foreach (self::$banks as $code => $bank) {
            if ($results_count == 10) break;

            if (mb_strpos($bank, $q) !== false) {
                $results[$code] = $bank;
                $results_count++;
            }
        }

        echo json_encode($results);
    }

}

?>
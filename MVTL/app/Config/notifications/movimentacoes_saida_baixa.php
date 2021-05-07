<?php

Configure::write('notifications.movimentacoes_saida_baixa', array(
    'query' => "SELECT * FROM `transactions` AS `Transaction`
                WHERE `Transaction`.`type` = '1'
                  AND IFNULL(`Transaction`.`baixa_value`, 0) = 0
                  AND DATEDIFF(
                      :date, str_to_date(`Transaction`.`pay_date`, '%d/%m/%Y')
                  ) = :param",
    'mapping' => array(
        '+1' => 'operacional',
        '+2' => 'tático',
        '+5' => 'estratégico'
    ),

    'object' => 'notifications_movimentacoes_saida_baixa_object',
    'message' => 'notifications_movimentacoes_saida_baixa_message',
    'data' => 'notifications_movimentacoes_saida_baixa_data'
));

function notifications_movimentacoes_saida_baixa_object($date, &$transaction)
{
    return $transaction['Transaction']['id'];
}

function notifications_movimentacoes_saida_baixa_message($date, &$transaction)
{
    return "Pagamento referênte ao movimento {$transaction['Transaction']['id']} em atraso";
}

function notifications_movimentacoes_saida_baixa_data($date, &$transaction)
{
    return array(
        'action' => array('controller' => 'module_fin_transactions', 'action' => 'update'),
        'options' => array
        (
            'pass' => array($transaction['Transaction']['id'])
        )
    );
}
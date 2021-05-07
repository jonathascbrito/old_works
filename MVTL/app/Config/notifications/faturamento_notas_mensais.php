<?php

Configure::write('notifications.faturamento_notas_mensais', array(
    'query' => "SELECT * FROM `contracts` AS `Contract`
                WHERE `Contract`.`type` IN ('3', '4')
                  AND DATEDIFF(:date, STR_TO_DATE(`Contract`.`start`, '%d/%m/%Y')) >= 0
                  AND DATEDIFF(:date, STR_TO_DATE(`Contract`.`end`, '%d/%m/%Y')) <= 0
                  AND DATEDIFF(
                      :date, STR_TO_DATE(CONCAT(SUBSTRING(`Contract`.`bill_date`, 1, 2), '/', MONTH(:date), '/', YEAR(:date)), '%d/%m/%Y')
                  ) = :param",
    'mapping' => array(
        '-5' => 'operacional',
        '-3' => 'tático',
        '-1' => 'estratégico',
        '-0' => 'jesus'
    ),

    'object' => 'notifications_faturamento_notas_mensais_object',
    'message' => 'notifications_faturamento_notas_mensais_message',
    'data' => 'notifications_faturamento_notas_mensais_data'
));

function notifications_faturamento_notas_mensais_object($date, &$contract)
{
    return $contract['Contract']['id'];
}

function notifications_faturamento_notas_mensais_message($date, &$contract)
{
    return "Cadastrar a nota para o contrato {$contract['Contract']['code_number']}/{$contract['Contract']['code_year']}";
}

function notifications_faturamento_notas_mensais_data($date, &$contract)
{
    return array(
        'action' => array('controller' => 'module_fin_faturamento', 'action' => 'create'),
        'options' => array
        (
            'pass' => array($contract['Contract']['id']),
            'data' => array(
                'ContractBilling' => array(
                    'date' => substr($contract['Contract']['bill_date'], 0, 2) . date('/m/Y', strtotime($date)),
                    'value' => $contract['Contract']['value'],
                    'description' => $contract['Contract']['object']
                )
            )
        )
    );
}
<?php

Configure::write('notifications.faturamento_notas_movimentacoes', array(
    'query' => "SELECT * FROM `contract_billings` AS `Billing`
                INNER JOIN `contracts` AS `Contract` ON `Billing`.`contract_id` = `Contract`.`id`
                INNER JOIN `entities` AS `Entity` ON `Contract`.`entity_id` = `Entity`.`id`
                INNER JOIN `results_centers` AS `ResultCenter` ON `Contract`.`result_center_id` = `ResultCenter`.`id`
                WHERE DATEDIFF(
                      :date, STR_TO_DATE(`Billing`.`date`, '%d/%m/%Y')
                  ) = :param",
    'mapping' => array(
        '-5' => 'operacional',
        '-3' => 'tático',
        '-1' => 'estratégico',
        '-0' => 'jesus'
    ),

    'object' => 'notifications_faturamento_notas_movimentacoes_object',
    'message' => 'notifications_faturamento_notas_movimentacoes_message',
    'data' => 'notifications_faturamento_notas_movimentacoes_data'
));

function notifications_faturamento_notas_movimentacoes_object($date, &$billing)
{
    return $billing['Billing']['id'];
}

function notifications_faturamento_notas_movimentacoes_message($date, &$billing)
{
    return "Provissionar o movimento para a nota {$billing['Billing']['number']}";
}

function notifications_faturamento_notas_movimentacoes_data($date, &$billing)
{
    return array(
        'action' => array('controller' => 'module_fin_transactions', 'action' => 'create'),
        'options' => array
        (
            'data' => array(
                'Transaction' => array(
                    'description' => "Movimento referente a nota {$billing['Billing']['number']} " .
                                     "do contrato {$billing['Contract']['code_number']}/{$billing['Contract']['code_year']}",
                    'type' => 0,
                    'entity_id' => $billing['Entity']['id'],
                    'entity_id_name' => $billing['Entity']['name'],
                    'bill_date' => $billing['Billing']['date'],
                    'pay_date' => substr($billing['Contract']['pay_date'], 0, 2) . date('/m/Y', strtotime($date)),
                    'value' => $billing['Billing']['value'],
                    'ResultsCenters' => array(
                        array(
                            'result_center_id' => $billing['ResultCenter']['id'],
                            'result_center_id_name' => $billing['ResultCenter']['name']
                        )
                    )
                )
            )
        )
    );
}
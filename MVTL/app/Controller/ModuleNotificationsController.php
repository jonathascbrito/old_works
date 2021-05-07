<?php

/**
 * ModuleMessagesController
 *
 * Controlador responsável pelo sistema de mensagens. Permite enviar e gerenciar
 * as mensagens do usuário autenticado.
 */
class ModuleNotificationsController extends AppController
{
    public $uses = array('Message', 'Notification');
    
    /**
     * Define o caminho utilizado pelo controlador para carregar as views.
     * @var string
     */
    public $path = 'Notifications';
    public $bundle = 'ModulesNotifications';

    public function index()
    {
        $this->set('notifications', $this->Notification->find('all'));
        $this->set('title', 'Módulos > Notificações');
    }
    
    public function update()
    {
        $this->isAjaxRequest(true);
        $this->autoRender = false;

        $data = array(
            'notifications' => $this->Notification->find('count'),
            'messages' => $this->Message->find('count', array('conditions' => array(
                'Message.readed' => 0,
                'Message.to' => $this->Auth->user('id')
            ))),
            'priority' => 'high'
        );
        
        $data['count'] = $data['notifications'] + $data['messages'];
        
        echo json_encode($data);
    }

    public function execute($id)
    {
        $this->autoRender = false;
        $this->Notification->id = $id;
        
        $notification = $this->Notification->read();
        $notification['Notification']['data'] = unserialize($notification['Notification']['data']);
        $notification['Notification']['data']['options'][] = 'return';

        echo $this->requestAction(
            $notification['Notification']['data']['action'],
            $notification['Notification']['data']['options']
        );
    }
    
    public function generate($name, $date = null)
    {
        $this->autoRender = false;

        $notifications = Configure::read('notifications');
        $notification =  $notifications[$name];
        
        $query = $notification['query'];
        $message = $notification['message'];
        $mapping = is_array($notification['mapping']) ? $notification['mapping']
                                                    : array($notification['mapping']);
        
        if (isset($_GET['reset'])) {
            echo '<h1>' . $name . '<br>--------------------------------------</h1>';
        }

        foreach ($mapping as $param => $group) {
            $rows = $this->Notification->query($query, array(
                'date' => $date,
                'param' => $param
            ));

            foreach ($rows as $row)
            {
                $new_notification = array('Notification' => array(
                    'name' => $name,
                    'date' => $date,

                    'object' => call_user_func($notification['object'], $notification, $row),
                    'message' => call_user_func($notification['message'], $notification, $row),
                    
                    'data' => serialize(
                        call_user_func($notification['data'], $date, $row)
                    )
                ));

                if ( ! $this->Notification->find('count', array('conditions' => $this->postConditions($new_notification))))
                {
                    $this->Notification->create();
                    $this->Notification->save($new_notification);
                    
                    if (isset($_GET['debug'])) {
                        echo '<pre>';
                            var_export($new_notification);
                            var_export($this->Notification->validationErrors);
                        echo '</pre>';
                    }
                }
            }
        }
    }
}

?>
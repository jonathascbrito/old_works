<?php

/**
 * DashboardController
 */
class DashboardController extends AppController
{

    public function index() {
        $this->redirect('/modules/messages/inbox');
    }

}

?>
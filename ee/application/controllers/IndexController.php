<?php

/**
 * IndexController
 */

class IndexController extends Zend_Controller_Action
{

    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        /* Initialize action controller here */
    }

    /**
     * indexAction
     *
     * @return void
     */
    public function indexAction()
    {
        $storage = new Zend_Auth_Storage_Session();
        $data = $storage->read();
        if (!$data) {
            $this->redirect('auth/login');
        }
        $this->view->user = $data;
    }

}


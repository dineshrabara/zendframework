<?php

/**
 * Class Users_IndexController
 */
class Users_IndexController extends Zend_Controller_Action
{
    /**
     * Users entries list action
     */
    public function indexAction()
    {
        $users = new Users_Model_UserMapper();
        $this->view->entries = $users->fetchAll();
    }


}


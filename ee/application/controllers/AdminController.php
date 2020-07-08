<?php
/**
 * Class AdminController
 */
class AdminController extends Zend_Controller_Action
{
    /**
     * init
     * Set flash message
     * Set current user detail
     * Check Islogin or not
     * @return void
     */
    public function init()
    {
        /* Initialize Common task here for admin panel */
        $storage = new Zend_Auth_Storage_Session();
        $currentUser = $storage->read();

        if (!$currentUser) {
            $this->redirect('users/login');
        }

        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }

        $this->view->currentUser = $currentUser;
    }

}
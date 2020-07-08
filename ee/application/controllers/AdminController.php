<?php
/**
 * Class AdminController
 */
class AdminController extends Zend_Controller_Action
{
    /**
     * @var for access control list
     */
    public $acl;

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
        $this->view->acl = $this->acl = $this->definedAcl();

        if (!$this->acl->isAllowed($currentUser->role, $this->getRequest()->getModuleName())) {
            throw new Zend_Acl_Exception('Access Denied');
        }

        $this->view->currentUser = $currentUser;
    }

    public function definedAcl()
    {
        $acl = new Zend_Acl();
        //add two role for normal can access only purchase, guest book, users
        $acl->addRole(new Zend_Acl_Role('normal'))
            ->addRole(new Zend_Acl_Role('admin'));

        //default
        $acl->addResource('default');
        //purchases
        $acl->addResource('purchases');

        //users
        $acl->addResource('users');

        //guestbook
        $acl->addResource('guestbook');

        $acl->allow('normal', ['default', 'purchases', 'guestbook']);
        $acl->allow('admin', ['default', 'purchases', 'guestbook', 'users']);
        return $acl;
    }

}
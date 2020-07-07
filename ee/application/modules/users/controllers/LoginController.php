<?php

/**
 * Class Users_LoginController
 */
class Users_LoginController extends Zend_Controller_Action
{

    /**
     * Init for layout auth
     */
    public function init()
    {
        $this->_helper->layout->setLayout('auth');
    }

    /**
     * Login form action get and post
     * @throws Zend_Form_Exception
     */
    public function indexAction()
    {
        $users = new Users_Model_User();
        $loginForm = new Users_Form_Login();
        $request = $this->getRequest();

        if ($this->getRequest()->isPost() && $loginForm->isValid($_POST)) {
            $data = $loginForm->getValues();
            $data['password'] = md5($data['password']);
            $auth = Zend_Auth::getInstance();

            $authAdapter = new Zend_Users_Adapter_DbTable($users->getAdapter(), 'users');
            $authAdapter->setIdentityColumn('email')->setCredentialColumn('password');
            $authAdapter->setIdentity($data['email'])->setCredential($data['password']);
            $result = $auth->authenticate($authAdapter);

            if ($result->isValid()) {
                $storage = new Zend_Users_Storage_Session();
                $storage->write($authAdapter->getResultRowObject());
                $this->redirect('/');
            }
            $this->view->errorMessage = "Invalid username or password. Please try again.";

        }

        $this->view->loginForm = $loginForm;
    }

    /**
     * for logout action
     */
    public function outAction()
    {
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->redirect('auth/login');
    }
}


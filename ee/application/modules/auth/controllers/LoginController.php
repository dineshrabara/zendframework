<?php

class Auth_LoginController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('auth');
    }

    public function indexAction()
    {
        $users = new Application_Model_User();
        $loginForm = new Application_Form_AuthLogin();
        $request = $this->getRequest();

        if ($this->getRequest()->isPost() && $loginForm->isValid($_POST)) {
            $data = $loginForm->getValues();
            $auth = Zend_Auth::getInstance();
            $authAdapter = new Zend_Auth_Adapter_DbTable($users->getAdapter(), 'users');
            $authAdapter->setIdentityColumn('email')
                ->setCredentialColumn('password');
            $authAdapter->setIdentity($data['email'])
                ->setCredential($data['password']);
            $result = $auth->authenticate($authAdapter);
            if ($result->isValid()) {
                $storage = new Zend_Auth_Storage_Session();
                $storage->write($authAdapter->getResultRowObject());
                $this->redirect('/');
            } else {
                $this->view->errorMessage = "Invalid username or password. Please try again.";
            }
        }

        $this->view->loginForm = $loginForm;
    }

    public function outAction()
    {
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->redirect('auth/login');
    }
}


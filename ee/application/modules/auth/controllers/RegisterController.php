<?php

class Auth_RegisterController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('auth');
    }

    public function indexAction()
    {
        $users = new Application_Model_User();
        $authRegister = new Application_Form_AuthRegister();
        $request = $this->getRequest();

        if ($this->getRequest()->isPost() && $authRegister->isValid($_POST)) {
            $data = $authRegister->getValues();
            unset($data['confirm_password']);
            $users->insert($data);
            return $this->redirect('/auth/login');
        }

        $this->view->authRegister = $authRegister;
    }


}


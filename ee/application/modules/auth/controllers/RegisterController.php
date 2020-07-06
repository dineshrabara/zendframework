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
            if ($data['password'] != $data['confirm_password']) {
                $this->view->errorMessage = "Password and confirm password not match Please check";
            }
            if ($users->checkUnique($data['email'])) {
                $this->view->errorMessage = "Email already taken. Please choose another one.";
            }
            if (empty($this->view->errorMessage)) {
                unset($data['confirm_password']);
                $data['password'] = md5($data['password']);
                $users->insert($data);
                return $this->redirect('/auth/login');
            }
        }

        $this->view->authRegister = $authRegister;
    }

}
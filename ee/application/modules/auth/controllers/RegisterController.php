<?php

class Auth_RegisterController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('auth');
    }

    public function indexAction()
    {
        $authRegister = new Application_Form_AuthRegister();
        $request = $this->getRequest();

        if ($this->getRequest()->isPost() && $authRegister->isValid($_POST)) {
            $data = $authRegister->getValues();
            $user = new Application_Model_User($data);
            $mapper = new Application_Model_UserMapper();

            if ($data['password'] != $data['confirm_password']) {
                $this->view->errorMessage = "Password and confirm password not match Please check";
            }
            if ($mapper->isExist($user, 'email')) {
                $this->view->errorMessage = "Email already taken. Please choose another one.";
            }
            if (empty($this->view->errorMessage)) {
                $mapper->register($user);
                return $this->redirect('/auth/login');
            }
        }

        $this->view->authRegister = $authRegister;
    }

}
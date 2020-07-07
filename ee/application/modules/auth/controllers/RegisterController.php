<?php

/**
 * Class Auth_RegisterController
 */
class Auth_RegisterController extends Zend_Controller_Action
{

    /**
     * Init for layout auth
     */
    public function init()
    {
        $this->_helper->layout->setLayout('auth');
    }

    /**
     * Register form action get and post
     * @throws Zend_Form_Exception
     */
    public function indexAction()
    {
        $authRegister = new Auth_Form_Register();
        $request = $this->getRequest();

        if ($this->getRequest()->isPost() && $authRegister->isValid($_POST)) {
            $data = $authRegister->getValues();
            $user = new Auth_Model_User($data);
            $mapper = new Auth_Model_UserMapper();

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
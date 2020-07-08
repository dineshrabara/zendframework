<?php
/**
 * Class Users_RegisterController
 */
class Users_RegisterController extends Zend_Controller_Action
{
    /**
     * Init for layout auth and central members
     */
    public function init()
    {
        $this->_helper->layout->setLayout('auth');
        $this->userService = new Users_Service_User();
    }

    /**
     * Register form action get and post
     * @throws Zend_Form_Exception
     */
    public function indexAction()
    {
        $authRegister = new Users_Form_Register();
        $request = $this->getRequest();

        if ($this->getRequest()->isPost() && $authRegister->isValid($_POST)) {
            $data = $authRegister->getValues();
            $user = new Users_Model_User($data);
            $mapper = new Users_Model_UserMapper();

            if ($data['password'] != $data['confirm_password']) {
                $this->view->errorMessage = "Password and confirm password not match Please check";
            }

            if ($mapper->isExist($user, 'email')) {
                $this->view->errorMessage = "Email already taken. Please choose another one.";
            }

            if (empty($this->view->errorMessage)) {
                $mapper->register($user);
                $this->userService->sendMail($user);
                return $this->redirect('/users/login');
            }

        }

        $this->view->authRegister = $authRegister;
    }

}
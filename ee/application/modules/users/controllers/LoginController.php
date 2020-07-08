<?php
/**
 * Class Users_LoginController
 */
class Users_LoginController extends Zend_Controller_Action
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
     * Login form action get and post
     * @throws Zend_Form_Exception
     */
    public function indexAction()
    {
        $loginForm = new Users_Form_Login();
        $request = $this->getRequest();

        if ($this->getRequest()->isPost() && $loginForm->isValid($_POST)) {

            if ($this->userService->login($loginForm)) {
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
        $this->userService->logOut();
        $this->redirect('users/login');
    }

}
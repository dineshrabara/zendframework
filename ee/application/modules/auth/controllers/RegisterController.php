<?php

class Auth_RegisterController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $authRegister = new Application_Form_AuthRegister();
        $request = $this->getRequest();

        if ($this->getRequest()->isPost() && $authRegister->isValid($_POST)) {
            echo "post";
        }

        $this->view->authRegister = $authRegister;
    }


}


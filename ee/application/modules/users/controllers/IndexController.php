<?php

/**
 * Class Users_IndexController
 */
class Users_IndexController extends Zend_Controller_Action
{
    /**
     * Get flash messages and pass to the view.
     */
    public function init()
    {
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->messages = $this->_helper->FlashMessenger->getMessages();
        }
    }

    /**
     * Users entries list action
     */
    public function indexAction()
    {
        $users = new Users_Model_UserMapper();
        $this->view->entries = $users->fetchAll();
    }

    public function editAction()
    {
        $requestParams = $this->getRequest()->getParams();
        if (empty($requestParams['id'])) {
            throw new Zend_Controller_Response_Exception('record not found', 404);
        }
        $registerForm = new Users_Form_Register();
        $user = new Users_Model_User($registerForm->getValues());
        $mapper = new Users_Model_UserMapper();
        $mapper->find($requestParams['id'], $user);

        $registerForm->populate($user->toArray());

        //Make password and confirm password field option if fill then apply validation
        if (!$registerForm->getValue('password')) {
            $registerForm->getElement('password')->setOptions(['required' => false])->clearValidators();
            $registerForm->getElement('confirm_password')->setOptions(['required' => false])->clearValidators();
        }


        if ($this->getRequest()->isPost() && $registerForm->isValid($_POST)) {
            $user->setOptions($registerForm->getValues());
            if ($mapper->isExist($user, 'email')) {
                $this->view->errorMessage = "Email already taken. Please choose another one.";
            }
            if (empty($this->view->errorMessage)) {
                $mapper->save($user);
                $this->_helper->FlashMessenger->addMessage(array('success' => "User <b>[{$user->getFirstName()}]</b> has been successfully updated."));
                return $this->redirect('/users');
            }
        }

        $this->view->registerForm = $registerForm;
    }


}


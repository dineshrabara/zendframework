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

    /**
     * Edit action
     * @throws Zend_Controller_Response_Exception
     * @throws Zend_Form_Exception
     */
    public function editAction()
    {
        $userId = $this->getRequest()->getParam('id');
        if (empty($userId)) {
            throw new Zend_Controller_Response_Exception('Wrong parameter', 404);
        }
        $registerForm = new Users_Form_Register();
        $user = new Users_Model_User($registerForm->getValues());
        $mapper = new Users_Model_UserMapper();
        $mapper->find($userId, $user);
        if (!$user->getId()) {
            throw new Zend_Controller_Response_Exception('Record not found in database', 404);
        }

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


    /**
     * Delete action
     */
    public function deleteAction()
    {
        $userId = $this->getRequest()->getParam('id');
        if ($this->getRequest()->isGet() && $userId) {
            $modelObj = new Users_Model_UserMapper();
            if ($modelObj->delete($userId)) {
                $this->_helper->FlashMessenger->addMessage(array('success' => "User has been successfully deleted."));
            } else {
                $this->_helper->FlashMessenger->addMessage(array('danger' => "Some error occurred while deleting user, Please try after some time."));
            }
            $this->redirect('/users');
        }
        throw new Zend_Controller_Response_Exception('Wrong parameter', 404);
    }
}


<?php

/**
 * Class GuestbookController
 */
class GuestbookController extends AdminController
{
    /**
     * Index action for list guestbook
     */
    public function indexAction()
    {
        $guestbook = new Application_Model_GuestbookMapper();
        $this->view->entries = $guestbook->fetchAll();
    }

    /**
     * Sign guestbook action
     * @return mixed
     * @throws Zend_Form_Exception
     */
    public function signAction()
    {
        $request = $this->getRequest();
        $form = new Application_Form_Guestbook();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Guestbook($form->getValues());
                $mapper = new Application_Model_GuestbookMapper();
                $mapper->save($comment);
                $this->_helper->FlashMessenger->addMessage(array('success' => "Guestbook has been successfully updated."));
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }


}



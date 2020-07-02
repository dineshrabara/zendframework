<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $guestbook = new Application_Model_GuestbookMapper();
        $this->view->entries = $guestbook->fetchAll();
    }

    public function signAction()
    {
        $mysession = new Zend_Session_Namespace('mysession');

        if (!isset($mysession->counter)) {
            $mysession->counter = 1000;
        } else {
            $mysession->counter++;
        }
        if ($mysession->counter > 1999) {
            unset($mysession->counter);
        }
        $request = $this->getRequest();
        $form = new Application_Form_Guestbook();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Guestbook($form->getValues());
                $mapper = new Application_Model_GuestbookMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
        $this->view->mysession = $mysession;
    }


}



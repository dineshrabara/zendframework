<?php

/**
 * Class Purchases_IndexController
 */
class Purchases_IndexController extends AdminController
{
    /**
     * Purchase entries list action
     */
    public function indexAction()
    {
        $purchases = new Purchases_Model_PurchaseMapper();
        $this->view->entries = $purchases->fetchAll();
    }

    public function storeAction()
    {
        $this->view->cardTitle = "New Purchase";
        $request = $this->getRequest();
        $purchaseForm = new Purchases_Form_Purchase();
        $purchase = new Purchases_Model_Purchase($purchaseForm->getValues());
        $mapper = new Purchases_Model_PurchaseMapper();

        if ($purchase_id = $request->getParam('id')) {
            $this->view->cardTitle = "Edit Purchase";
            $mapper->find($purchase_id, $purchase);
            $purchaseForm->populate($purchase->toArray());
            $purchaseForm->getElement('submit')->setLabel('Update')->setAttrib('class', 'btn btn-primary');
        }

        if ($request->isPost() && $purchaseForm->isValid($request->getPost())) {
            $purchase->setOptions($purchaseForm->getValues());
            $mapper->save($purchase);
            $this->_helper->FlashMessenger->addMessage(array('success' => "Purchase has been successfully store."));
            return $this->redirect('/purchases/index');
        }

        $this->view->purchaseForm = $purchaseForm;
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        $purchaseId = $this->getRequest()->getParam('id');

        if ($this->getRequest()->isPost() && $purchaseId) {
            $mapper = new Purchases_Model_PurchaseMapper();

            if ($mapper->delete($purchaseId)) {
                $this->_helper->FlashMessenger->addMessage(array('success' => "Purchase has been successfully deleted."));
            } else {
                $this->_helper->FlashMessenger->addMessage(array('danger' => "Some error occurred while deleting Purchase, Please try after some time."));
            }

            $this->redirect('/purchases');
        }

        throw new Zend_Controller_Response_Exception('Wrong parameter', 404);
    }
}
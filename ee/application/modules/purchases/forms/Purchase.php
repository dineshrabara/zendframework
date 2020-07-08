<?php
/**
 * Class Purchases_Form_Purchase
 */
class Purchases_Form_Purchase extends Zend_Form
{
    /**
     * @throws Zend_Form_Exception
     */
    public function init()
    {
        $this->setMethod('post');
        $this->setAttrib('class', 'form-horizontal'); // For Bootstrap Form
        $this->setAttrib('role', 'form'); // For Bootstrap Form

        //ledger field
        $ledger = new Zend_Form_Element_Text('ledger_id');
        $ledger->setAttrib('class', 'form-control');
        $ledger->setDecorators($this->getBootstrapDecorator());
        $ledger->setLabel('Ledger:');
        $ledger->setRequired(true);
        $ledger->setFilters(['StringTrim']);
        $this->addElement($ledger);

        //purchase date field
        $purchaseDate = new Zend_Form_Element_Text('purchase_date');
        $purchaseDate->setAttrib('class', 'form-control');
        $purchaseDate->setDecorators($this->getBootstrapDecorator());
        $purchaseDate->setLabel('Date:');
        $purchaseDate->setRequired(true);
        $purchaseDate->setFilters(['StringTrim']);
        $this->addElement($purchaseDate);

        // Add CSRF protection.
        $this->addElement('hash', 'csrf');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setDecorators($this->getBootstrapDecorator());
        $submit->setLabel('Save');
        $submit->setIgnore(true);
        $submit->setAttrib('class', 'btn btn-primary');
        $submit->removeDecorator('label');
        $this->addElement($submit);
    }

    /**
     * Apply Bootstrap decorators to an element.
     * @return array
     */
    private function getBootstrapDecorator()
    {
        return [
            'ViewHelper',
            'Description',
            'Errors',
            [
                'Label',
                [
                    'class' => 'form-label'
                ]
            ],
            [
                'HtmlTag',
                [
                    'class' => 'form-control'
                ]
            ]
        ];
    }

}
<?php
/**
 * Class Purchases_Form_PurchaseItems
 */
class Purchases_Form_PurchaseItems extends Zend_Form
{
    /**
     * @throws Zend_Form_Exception
     */
    public function init()
    {
        //item field
        $item = new Zend_Form_Element_Text('item_id');
        $item->setAttrib('class', 'form-control');
        $item->setDecorators($this->getBootstrapDecorator());
        $item->setLabel('Item:');
        $item->setRequired(true);
        $item->setFilters(['StringTrim']);
        $this->addElement($ledger);

        //item_description field
        $itemDescription = new Zend_Form_Element_Text('item_description');
        $itemDescription->setAttrib('class', 'form-control');
        $itemDescription->setDecorators($this->getBootstrapDecorator());
        $itemDescription->setLabel('Item Description:');
        $itemDescription->setRequired(true);
        $itemDescription->setFilters(['StringTrim']);
        $this->addElement($itemDescription);

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
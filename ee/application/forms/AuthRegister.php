<?php

class Application_Form_AuthRegister extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');

        $this->addElement(
            'text', 'email', array(
            'label' => 'Email:',
            'required' => true,
            'filters' => array('StringTrim'),
        ));

        $this->addElement('password', 'password', array(
            'label' => 'Password:',
            'required' => true,
        ));
        $this->addElement('password', 'confirm_password', array(
            'label' => 'Confirm Password:',
            'required' => true,
        ));

        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Login',
        ));
    }


}


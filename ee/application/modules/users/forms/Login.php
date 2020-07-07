<?php

/**
 * Class Users_Form_Login
 */
class Users_Form_Login extends Zend_Form
{
    /**
     * @throws Zend_Form_Exception
     */
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

        // Add CSRF protection.
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Login',
        ));
    }


}


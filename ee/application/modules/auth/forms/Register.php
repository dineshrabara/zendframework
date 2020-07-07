<?php

/**
 * Class Auth_Form_Register
 */
class Auth_Form_Register extends Zend_Form
{

    /**
     * @throws Zend_Form_Exception
     */
    public function init()
    {
        $this->setMethod('post');

        $this->addElement(
            'text', 'first_name', array(
            'label' => 'First Name:',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 50)),
            ),
        ));
        $this->addElement(
            'text', 'last_name', array(
            'label' => 'Last Name:',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 50)),
            ),
        ));
        $this->addElement(
            'text', 'email', array(
            'label' => 'Email:',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 50)),
            ),
        ));

        $this->addElement('password', 'password', array(
            'label' => 'Password:',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(8, 32)),
            ),
        ));
        $this->addElement('password', 'confirm_password', array(
            'label' => 'Confirm Password:',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(8, 32)),
            ),
        ));

        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Login',
        ));
    }


}


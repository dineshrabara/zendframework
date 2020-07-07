<?php

/**
 * Class Users_Form_Register
 */
class Users_Form_Register extends Zend_Form
{

    /**
     * @throws Zend_Form_Exception
     */
    public function init()
    {
        $this->setMethod('post');
        $this->setAttrib('class', 'card'); // For Bootstrap Form
        $this->setAttrib('role', 'form'); // For Bootstrap Form

        $firstName = new Zend_Form_Element_Text('first_name');
        $firstName->setAttrib('class', 'form-control');
        $firstName->setAttrib('placeholder', 'First Name');
        $firstName->setDecorators($this->getBootstrapDecorator());
        $firstName->setLabel('First Name:');
        $firstName->setRequired(true);
        $firstName->setFilters(['StringTrim']);
        $firstName->setValidators(array(
            array('validator' => 'StringLength', 'options' => array(0, 50)),
        ));
        $this->addElement($firstName);

        $lastName = new Zend_Form_Element_Text('last_name');
        $lastName->setAttrib('class', 'form-control');
        $lastName->setAttrib('placeholder', 'Last Name');
        $lastName->setDecorators($this->getBootstrapDecorator());
        $lastName->setLabel('Last Name:');
        $lastName->setRequired(true);
        $lastName->setFilters(['StringTrim']);
        $lastName->setValidators(array(
            array('validator' => 'StringLength', 'options' => array(0, 50)),
        ));
        $this->addElement($lastName);

        //email field
        $email = new Zend_Form_Element_Text('email');
        $email->setAttrib('class', 'form-control');
        $email->setAttrib('placeholder', 'Enter email');
        $email->setDecorators($this->getBootstrapDecorator());
        $email->setLabel('Email Address:');
        $email->setRequired(true);
        $email->setFilters(['StringTrim']);
        $email->setValidators(array(
            array('validator' => 'StringLength', 'options' => array(0, 50)),
        ));
        $this->addElement($email);

        $password = new Zend_Form_Element_Password('password');
        $password->setAttrib('class', 'form-control');
        $password->setAttrib('placeholder', 'Password');
        $password->setDecorators($this->getBootstrapDecorator());
        $password->setLabel('Password:');
        $password->setRequired(true);
        $password->setFilters(['StringTrim']);
        $email->setValidators(array(
            array('validator' => 'StringLength', 'options' => array(8, 32)),
        ));
        $this->addElement($password);

        $confirm_password = clone $password;
        $confirm_password->setName('confirm_password');
        $confirm_password->setAttrib('placeholder', 'Confirm Password');
        $confirm_password->setLabel('Confirm Password');
        $this->addElement($confirm_password);

        // Add CSRF protection.
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setDecorators($this->getBootstrapDecorator());
        $submit->setLabel('Register');
        $submit->setIgnore(true);
        $submit->setAttrib('class', 'btn btn-primary btn-block');
        $submit->removeDecorator('label');
        $this->addElement($submit);
    }

    /**
     * Apply Bootstrap decorators to an element.
     * @return array
     */
    private function getBootstrapDecorator()
    {
        return array(
            'ViewHelper',
            'Description',
            'Errors',
            array(
                'Label',
                array(
                    'class' => 'form-label'
                )
            ),
            array(
                'HtmlTag',
                array(
                    'class' => 'form-control'
                )
            )
        );
    }

}


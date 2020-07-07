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
        $this->setAttrib('class', 'card'); // For Bootstrap Form
        $this->setAttrib('role', 'form'); // For Bootstrap Form

        //email field
        $email = new Zend_Form_Element_Text('email');
        $email->setAttrib('class', 'form-control');
        $email->setAttrib('placeholder', 'Enter email');
        $email->setDecorators($this->getBootstrapDecorator());
        $email->setLabel('Email Address:');
        $email->setRequired(true);
        $email->setFilters(['StringTrim']);
        $this->addElement($email);

        //password field
        $password = new Zend_Form_Element_Text('password');
        $password->setAttrib('class', 'form-control');
        $password->setAttrib('placeholder', 'Password');
        $password->setDecorators($this->getBootstrapDecorator());
        $password->setLabel('Password:');
        $password->setRequired(true);
        $password->setFilters(['StringTrim']);
        $this->addElement($password);


        // Add CSRF protection.
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setDecorators($this->getBootstrapDecorator());
        $submit->setLabel('Login');
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


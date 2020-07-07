<?php

class Application_Form_Guestbook extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'email', [
            'label' => 'Your email address:',
            'required' => true,
            'filters' => ['StringTrim'],
            'validators' => [
                'EmailAddress',
            ],
        ]);

        // Add the comment element
        $this->addElement('textarea', 'comment', [
            'label' => 'Please Comment:',
            'required' => true,
            'validators' => [
                ['validator' => 'StringLength', 'options' => [0, 20]],
            ],
        ]);

        // Add a captcha
        $this->addElement('captcha', 'captcha', [
            'label' => 'Please enter the 5 letters displayed below:',
            'required' => true,
            'captcha' => [
                'captcha' => 'Dumb',
                'wordLen' => 5,
                'timeout' => 300,
            ],
        ]);

        // Add the submit button
        $this->addElement('submit', 'submit', [
            'ignore' => true,
            'label' => 'Sign Guestbook',
        ]);

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf');
    }

}
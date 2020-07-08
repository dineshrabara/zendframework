<?php
/**
 * Class Users_User_Service
 */
class Users_Service_User
{
    /**
     * @return array
     * @throws Exception
     */
    public function getEntries(): array
    {
        $users = new Users_Model_UserMapper();
        return $users->fetchAll();
    }

    /**
     * @param $userId
     * @return mixed
     * @throws Exception
     */
    public function delete($userId)
    {
        $mapper = new Users_Model_UserMapper();
        return $mapper->delete($userId);
    }

    /**
     * @param Zend_Form $form
     * @return bool
     * @throws Exception
     */
    public function login(Zend_Form $form): bool
    {
        $user = new Users_Model_User($form->getValues());
        $mapper = new Users_Model_UserMapper();
        $auth = Zend_Auth::getInstance();
        $authAdapter = $mapper->login($user);
        $result = $auth->authenticate($authAdapter);

        if ($result->isValid()) {
            $storage = new Zend_Auth_Storage_Session();
            $storage->write($authAdapter->getResultRowObject());
            return true;
        }
        return false;
    }

    /**
     * logout service
     */
    public function logOut()
    {
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
    }

    /**
     * @param Users_Model_User $user
     * @throws Zend_Mail_Exception
     */
    public function sendMail(Users_Model_User $user)
    {
        $transport = new Zend_Mail_Transport_Smtp();
        $mail = new Zend_Mail();
        $mail->setDefaultTransport($transport);
        $mail->setBodyText('
               Dear User,
               
               Welcome to demo application mail functionalities 
               
               Thanks
               Dinesh
        ');
        $mail->setFrom('d.rabara@easterenterprise.com', 'Dinesh Rabara');
        $mail->addTo($user->getEmail(), $user->getFirstName());
        $mail->setSubject('Welcome to demo application');
        $mail->send();
    }
}
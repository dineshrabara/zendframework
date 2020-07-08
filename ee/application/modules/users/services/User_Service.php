<?php
/**
 * Class Users_User_Service
 */

class Users_User_Service
{
    public function getEntries()
    {
        $users = new Users_Model_UserMapper();
        return $users->fetchAll();
    }
}
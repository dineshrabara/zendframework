<?php

class Application_Model_User extends Zend_Db_Table
{
    protected $_name = "users";

    function checkUnique($username)
    {
        $select = $this->_db->select()
            ->from($this->_name, array('email'))
            ->where('email=?', $username);
        $result = $this->getAdapter()->fetchOne($select);
        if ($result) {
            return true;
        }
        return false;
    }
}


<?php

/**
 * Class Auth_Model_UserMapper
 */
class Auth_Model_UserMapper
{
    /**
     * @var
     */
    protected $_dbTable;

    /**
     * @param $dbTable
     * @return $this
     * @throws Exception
     */
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Auth_Model_DbTable_User');
        }
        return $this->_dbTable;
    }

    /**
     * @param Auth_Model_User $user
     * @throws Exception
     */
    public function register(Auth_Model_User $user)
    {
        $data = array(
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->getDbTable()->insert($data);
    }

    /**
     * @param Auth_Model_User $user
     * @param null $field
     * @return bool
     * @throws Exception
     */
    function isExist(Auth_Model_User $user, $field = null)
    {
        $select = $this->getDbTable()->select()
            ->from($this->_dbTable, [$field])
            ->where("$field=?", $user->{$user->getMethod($field, 'get')}());
        $result = $select->getAdapter()->fetchOne($select);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @param Auth_Model_User $user
     * @throws Exception
     */
    public function find($id, Auth_Model_User $user)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $user->setId($row->id)
            ->setEmail($row->email)
            ->setFirstName($row->first_name)
            ->setCreated($row->created);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Auth_Model_User();
            $entry->setId($row->id)
                ->setEmail($row->email)
                ->setFirstName($row->comment)
                ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }

}


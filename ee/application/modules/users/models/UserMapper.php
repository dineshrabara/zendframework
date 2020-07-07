<?php

/**
 * Class Users_Model_UserMapper
 */
class Users_Model_UserMapper
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
            $this->setDbTable('Users_Model_DbTable_User');
        }
        return $this->_dbTable;
    }

    /**
     * @param Users_Model_User $user
     * @throws Exception
     */
    public function register(Users_Model_User $user)
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
     * @param Users_Model_User $user
     * @param null $field
     * @return bool
     * @throws Exception
     */
    function isExist(Users_Model_User $user, $field = null)
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
     * @param Users_Model_User $user
     * @throws Exception
     */
    public function find($id, Users_Model_User $user)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $user->setId($row->id)
            ->setEmail($row->email)
            ->setFirstName($row->first_name)
            ->setLastName($row->first_name)
            ->setCreated($row->created_at);
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
            $entry = new Users_Model_User();
            $entry->setId($row->id)
                ->setEmail($row->email)
                ->setFirstName($row->first_name)
                ->setLastName($row->last_name)
                ->setCreatedAt($row->created_at);
            $entries[] = $entry;
        }
        return $entries;
    }

    /**
     * @param Users_Model_User $user
     * @return Zend_Auth_Adapter_DbTable
     * @throws Exception
     */
    public function login(Users_Model_User $user)
    {
        $select = $this->getDbTable()->select();
        $authAdapter = new Zend_Auth_Adapter_DbTable($select->getAdapter(), 'users');
        $authAdapter->setIdentityColumn('email')->setCredentialColumn('password');
        $authAdapter->setIdentity($user->getEmail())->setCredential($user->getPassword());

        return $authAdapter;
    }

}


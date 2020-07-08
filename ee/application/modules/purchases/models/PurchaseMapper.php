<?php
/**
 * Class Purchases_Model_PurchaseMapper
 */
class Purchases_Model_PurchaseMapper
{
    /**
     * @var
     */
    private $_dbTable;

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
            $this->setDbTable('Purchases_Model_DbTable_Purchase');
        }
        return $this->_dbTable;
    }

    /**
     * @param Purchases_Model_Purchase $Purchase
     * @throws Exception
     */
    public function save(Purchases_Model_Purchase $Purchase)
    {
        $data = $Purchase->toArray();

        if (!$Purchase->getCreatedAt()) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        if (null === ($id = $Purchase->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }

    }

    /**
     * @param $id
     * @param Purchases_Model_Purchase $Purchase
     * @throws Exception
     */
    public function find($id, Purchases_Model_Purchase $Purchase)
    {
        $result = $this->getDbTable()->find($id);

        if (0 == count($result)) {
            return;
        }

        $row = $result->current();
        $Purchase->setId($row->id)
            ->setLedgerId($row->ledger_id)
            ->setPurchaseDate($row->purchase_date)
            ->setCreatedAt($row->created_at);
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
            $entry = new Purchases_Model_Purchase();
            $entry->setId($row->id)
                ->setLedgerId($row->ledger_id)
                ->setPurchaseDate($row->purchase_date)
                ->setCreatedAt($row->created_at);
            $entries[] = $entry;
        }
        return $entries;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function delete($id)
    {
        return $this->getDbTable()->delete("id = $id");
    }

}
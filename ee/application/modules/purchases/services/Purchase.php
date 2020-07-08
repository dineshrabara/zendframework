<?php
/**
 * Class Purchases_Purchase_Service
 */
class Purchases_Service_Purchase
{
    /**
     * @return array
     * @throws Exception
     */
    public function getEntries(): array
    {
        $Purchases = new Purchases_Model_PurchaseMapper();
        return $Purchases->fetchAll();
    }

    /**
     * @param $PurchaseId
     * @return mixed
     * @throws Exception
     */
    public function delete($PurchaseId)
    {
        $mapper = new Purchases_Model_PurchaseMapper();
        return $mapper->delete($PurchaseId);
    }
}
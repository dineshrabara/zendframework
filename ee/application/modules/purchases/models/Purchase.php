<?php
/**
 * Class Purchases_Model_Purchase
 */
class Purchases_Model_Purchase
{
    /**
     * @fields
     */
    private $_ledger_id;
    private $_purchase_date;
    private $_id;

    /**
     * Purchases_Model_Purchase constructor.
     * @param array|null $options
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * @param $name
     * @param $value
     * @throws Exception
     */
    public function __set($name, $value)
    {
        $method = $this->getMethodName($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Purchase property');
        }
        $this->$method($value);
    }

    /**
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function __get($name)
    {
        $method = $this->getMethodName($name, 'get');
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Purchase property');
        }
        return $this->$method();
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = $this->getMethodName($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * @param $name
     * @param string $prefix
     * @return string
     */
    public function getMethodName($name, $prefix = 'set'): string
    {
        return $prefix . str_replace('_', '', ucwords($name, '_'));
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setLedgerId(string $text): self
    {
        $this->_ledger_id = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getLedgerId(): string
    {
        return ucfirst($this->_ledger_id);
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setPurchaseDate(string $text): self
    {
        $this->_purchase_date = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurchaseDate(): string
    {
        return ucfirst($this->_purchase_date);
    }

    /**
     * @param string $ts
     * @return $this
     */
    public function setCreatedAt(string $ts): self
    {
        $this->_created_at = $ts;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Convert object to Array
     * @return array
     */
    public function toArray(): array
    {
        return [
            'ledger_id' => $this->getLedgerId(),
            'purchase_date' => $this->getPurchaseDate(),
            'id' => $this->getId()
        ];
    }

}
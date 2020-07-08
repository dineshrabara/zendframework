<?php
/**
 * Class Users_Model_User
 */
class Users_Model_User
{
    /**
     * @fields
     */
    private $_created_at;
    private $_password;
    private $_email;
    private $_last_name;
    private $_first_name;
    private $_id;

    /**
     * Users_Model_User constructor.
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
            throw new Exception('Invalid user property');
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
            throw new Exception('Invalid user property');
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
    public function setFirstName(string $text): self
    {
        $this->_first_name = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return ucfirst($this->_first_name);
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setLastName(string $text): self
    {
        $this->_last_name = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return ucfirst($this->_last_name);
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->_email = (string)$email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->_password = $password ? md5($password) : '';
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
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
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
            'id' => $this->getId()
        ];
    }

}
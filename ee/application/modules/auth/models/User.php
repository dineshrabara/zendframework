<?php

/**
 * Class Auth_Model_User
 */
class Auth_Model_User
{
    /**
     * @fields
     */
    protected $_created_at;
    protected $_password;
    protected $_email;
    protected $_last_name;
    protected $_first_name;
    protected $_id;

    /**
     * Auth_Model_User constructor.
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
        $method = 'set' . $name;
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
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
        }
        return $this->$method();
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = $this->getMethod($key);
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
    public function getMethod($name, $prefix = 'set'): string
    {
        return $prefix . str_replace('_', '', ucwords($name, '_'));
    }

    /**
     * @param $text
     * @return $this
     */
    public function setFirstName($text)
    {
        $this->_first_name = (string)$text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_first_name;
    }

    /**
     * @param $text
     * @return $this
     */
    public function setLastName($text)
    {
        $this->_last_name = (string)$text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_last_name;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->_email = (string)$email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->_password = md5((string)$password);
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
     * @param $ts
     * @return $this
     */
    public function setCreatedAt($ts)
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
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->_id = (int)$id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

}


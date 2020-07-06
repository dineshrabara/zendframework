<?php

class Application_Model_User
{
    protected $_created_at;
    protected $_password;
    protected $_email;
    protected $_last_name;
    protected $_first_name;
    protected $_id;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
        }
        return $this->$method();
    }

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

    public function getMethod($name, $prefix = 'set'): string
    {
        return $prefix . str_replace('_', '', ucwords($name, '_'));
    }

    public function setFirstName($text)
    {
        $this->_first_name = (string)$text;
        return $this;
    }

    public function getFirstName()
    {
        return $this->_first_name;
    }

    public function setLastName($text)
    {
        $this->_last_name = (string)$text;
        return $this;
    }

    public function getLastName()
    {
        return $this->_last_name;
    }

    public function setEmail($email)
    {
        $this->_email = (string)$email;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setPassword($password)
    {
        $this->_password = md5((string)$password);
        return $this;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setCreatedAt($ts)
    {
        $this->_created_at = $ts;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    public function setId($id)
    {
        $this->_id = (int)$id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

}


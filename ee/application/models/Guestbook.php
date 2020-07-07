<?php
/**
 * Class Application_Model_Guestbook
 */
class Application_Model_Guestbook
{
    /**
     * @var fields
     */
    private $_comment;
    private $_created;
    private $_email;
    private $_id;

    /**
     * Application_Model_Guestbook constructor.
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
            throw new Exception('Invalid guestbook property');
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
            throw new Exception('Invalid guestbook property');
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
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setComment(string $text): self
    {
        $this->_comment = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->_comment;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->_email = $email;
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
     * @param string $ts
     * @return $this
     */
    public function setCreated(string $ts): self
    {
        $this->_created = $ts;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->_created;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self
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
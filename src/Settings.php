<?php
namespace Mandriller;

/**
 * Reads settings over .env
 */
class Settings
{
    protected $key;
    protected $username;

    protected $from_email;
    protected $from_name;

    public function __construct()
    {
        $this->key = env('MANDRILL_KEY');
        if (!$this->key) {
            throw new \Exception("MANDRILL_KEY is missing in .env");
        }
        $this->username = env('MANDRILL_USERNAME');
        if (!$this->username) {
            throw new \Exception("MANDRILL_USERNAME is missing in .env");
        }
        $this->from_email = get_bloginfo('admin_email');
        $this->from_name = get_bloginfo('title');
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new \Exception("Property $property does'nt exist");
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new \Exception("Property $property does'nt exist");
        }
        return $this;
    }
}

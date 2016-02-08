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
        $this->key = papi_get_option('mandrill_key');
        $this->username = papi_get_option('mandrill_from');

ENV!

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

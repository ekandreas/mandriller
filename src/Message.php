<?php
namespace Mandriller;

/**
 * 
 */
class Message
{
    protected $subject;
    protected $body;
    protected $preamble;
    protected $to_email;
    protected $to_name;
    protected $from_email;
    protected $from_name;
    protected $reply_to;

    protected $success;
    protected $error;
    protected $result;

    public function __construct()
    {
        $settings = new Settings();
        $this->reply_to = get_bloginfo('admin_email');
        $this->from_email = $settings->from_email;
        $this->from_name = $settings->from_name;
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

    public function transform()
    {
        $this->preamble = strip_tags($this->body);
        if (strlen($this->preamble)>100) {
            $this->preamble = substr($this->preamble, 0, 99) . '...';
        };

        // översätta users, etc?
    }
}

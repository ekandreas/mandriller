<?php
namespace Mandriller;

/**
 * Sends mail over Mandrill
 */
class Mailer
{

    protected $success;
    protected $error;
    protected $message;
    protected $result;

    public function send($message)
    {
        $message->transform();
        $this->message = $message;

        $settings = new \Mandriller\Settings();

        $mandrill = new \Mandrill($settings->key);
        $message = [
            'html'          => $this->message->body,
            'text'          => $this->message->preamble,
            'auto_html'     => true,
            'subject'       => $this->message->subject,
            'from_email'    => $this->message->from_email,
            'from_name'     => $this->message->from_name,
            'to'            => [
                [
                    'email' => $this->message->to_email,
                    'name'  => $this->message->to_name,
                    'type'  => 'to',
                ],
            ],
            'headers'       => ['Reply-To' => $this->message->reply_to],
        ];
        $async = false;
        try {
            $this->result = $mandrill->messages->send($message, $async);
            $this->success=true;
        } catch (Mandrill_Error $e) {
            $this->error = $e->getMessage();
            $this->success=true;
        }
    }

    public static function initPHPMailer($phpmailer)
    {
        $settings = new \Mandriller\Settings();
        $phpmailer->isSMTP();
        $phpmailer->SMTPAuth = true;
        $phpmailer->SMTPSecure = 'tls';
        $phpmailer->Host = 'smtp.mandrillapp.com';
        $phpmailer->Port = '587';
        $phpmailer->Username = $settings->username;
        $phpmailer->Password = $settings->key;
        $phpmailer->From = $settings->from_email;
        $phpmailer->FromName = $settings->from_name;
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

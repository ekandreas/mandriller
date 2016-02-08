<?php

function mandriller($subject, $body, $email, $name='')
{
    $message = new Mandriller\Message();
    $message->subject = $subject;
    $message->body=$body;
    $message->to_email=$email;
    $message->to_name = $name;

    $mailer = new Mandriller\Mailer();
    $mailer->send($message);
    return $mailer;
}

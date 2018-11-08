<?php


namespace Model\Form;


class FeedbackForm
{
    public $name;
    public $email;
    public $message;

    public function __construct($name, $email,$message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function isValid()
    {
        return $this->name && $this->email && $this->message;
    }
}
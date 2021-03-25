<?php


namespace Grafstorm\FortySixElksChannel;

use Grafstorm\FortySixElksChannel\Validators\MessageValidator;
use Grafstorm\FortySixElksChannel\Validators\ToValidator;

class SmsMessage
{
    public string $to;
    public string $message;

    /**
     * SmsMessage constructor.
     * @param string $to
     * @param string $message
     */
    public function __construct(string $to, string $message)
    {
        $this->to = ToValidator::validate($to);
        $this->message = MessageValidator::validate($message);
    }
}

<?php


namespace Grafstorm\FortySixElksChannel;

use Grafstorm\FortySixElksChannel\Validators\FromValidator;
use Grafstorm\FortySixElksChannel\Validators\MessageValidator;
use Grafstorm\FortySixElksChannel\Validators\ToValidator;
use Illuminate\Contracts\Support\Arrayable;

class SmsMessage implements Arrayable
{
    public string $smsTo;
    public string $smsFrom;
    public string $message;
    protected $lines;

    /**
     * SmsMessage constructor.
     * @param string $to
     * @param string $message
     */
    public function __construct($lines = [])
    {
        $this->lines = collect($lines);
        $this->smsFrom = FromValidator::validate(config('46elks-notification-channel.from'));
    }

    public function line($line = '')
    {
        $this->lines->push($line);

        return $this;
    }

    public function to($to)
    {
        $this->smsTo = ToValidator::validate($to);

        return $this;
    }

    public function from($from)
    {
        $this->smsFrom = FromValidator::validate($from);

        return $this;
    }

    public function toArray(): array
    {
        return [
            'to' => $this->smsTo,
            'from' => $this->smsFrom,
            'message' => MessageValidator::validate($this->lines->join("\n", "")),
        ];
    }
}

<?php


namespace Grafstorm\FortySixElksChannel;

use Grafstorm\FortySixElksChannel\Validators\FromValidator;

class FortySixElks
{
    private string $shouldDryRun = 'no';
    private string $from;
    private string $to;
    private string $message;
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public static function create(SmsMessage $message): static
    {
        $instance = new static;
        $instance->from = FromValidator::validate(config('46elks-notification-channel.from'));
        $instance->to = $message->to;
        $instance->message = $message->message;

        return $instance;
    }

    public function dryRun($dry = 'yes'): self
    {
        $this->shouldDryRun = $dry;

        return $this;
    }

    public function send(): mixed
    {
        return $this->client->sendSms([
            'from' => $this->from,
            'to' => $this->to,
            'message' => $this->message,
            'dryrun' => $this->shouldDryRun,
        ]);
    }
}

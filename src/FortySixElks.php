<?php


namespace Grafstorm\FortySixElksChannel;

class FortySixElks
{
    private string $shouldDryRun = 'no';
    private SmsMessage $smsMessage;
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public static function create(SmsMessage $message): static
    {
        $instance = new static;
        $instance->smsMessage = $message;

        return $instance;
    }

    public function dryRun($dry = 'yes'): self
    {
        $this->shouldDryRun = $dry;

        return $this;
    }

    public function send(): mixed
    {
        return $this->client->sendSms(array_merge(
            $this->smsMessage->toArray(),
            ['dryrun' => $this->shouldDryRun]
        ));
    }
}

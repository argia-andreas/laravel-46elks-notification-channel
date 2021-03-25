<?php


namespace Grafstorm\FortySixElksChannel;

use Grafstorm\FortySixElksChannel\Exceptions\ConfigException;
use Grafstorm\FortySixElksChannel\Exceptions\FortySixElksException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use TypeError;

class Client
{
    private PendingRequest $httpClient;

    public function __construct()
    {
        $user = config('46elks-notification-channel.user');
        $pass = config('46elks-notification-channel.pass');
        $base_url = config('46elks-notification-channel.base_url');

        try {
            $this->httpClient = Http::baseUrl($base_url)->withBasicAuth($user, $pass)->asForm();
        } catch (TypeError $e) {
            throw new ConfigException($e);
        }
    }

    public function sendSms(array $data): mixed
    {
        try {
            $response = $this->httpClient->post('sms', $data);
            throw_unless($response->status() === 200, FortySixElksException::class, $response->body());

            return $response->json();
        } catch (\Exception $e) {
            throw new FortySixElksException($e->getMessage());
        }
    }
}

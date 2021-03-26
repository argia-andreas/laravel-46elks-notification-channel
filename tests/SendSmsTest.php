<?php

namespace Grafstorm\FortySixElksChannel\Tests;

use Grafstorm\FortySixElksChannel\FortySixElks;
use Grafstorm\FortySixElksChannel\SmsMessage;

class SendSmsTest extends TestCase
{
    /** @test */
    public function sends_a_sms()
    {
        $this->markTestSkipped('Can only be tested with API keys.');
        // Setup a notifiable instance
        // Create a notification
        // Send using notification channel
        config(['46elks-notification-channel.user' => '::user::']);
        config(['46elks-notification-channel.pass' => '::password::']);
        config(['46elks-notification-channel.from' => 'sender']);
        $sms = (new SmsMessage())->to('+461')->line('::message::');

        $smsData = FortySixElks::create($sms)->dryRun()->send();

        $this->assertArrayHasKey('status', $smsData);
    }
}

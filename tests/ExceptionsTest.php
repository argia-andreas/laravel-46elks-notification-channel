<?php

namespace Grafstorm\FortySixElksChannel\Tests;

use Grafstorm\FortySixElksChannel\Exceptions\ConfigException;
use Grafstorm\FortySixElksChannel\Exceptions\FortySixElksException;
use Grafstorm\FortySixElksChannel\Exceptions\FromException;
use Grafstorm\FortySixElksChannel\Exceptions\MessageException;
use Grafstorm\FortySixElksChannel\Exceptions\ToException;
use Grafstorm\FortySixElksChannel\FortySixElks;
use Grafstorm\FortySixElksChannel\SmsMessage;

class ExceptionsTest extends TestCase
{
    /** @test */
    public function it_throws_exception_on_invalid_phonenumber_()
    {
        $this->expectException(ToException::class);

        config(['46elks-notification-channel.user' => '::replace-with-test-user::']);
        config(['46elks-notification-channel.pass' => '::replace-with-test-pass']);
        config(['46elks-notification-channel.from' => 'sender']);
        $sms = (new SmsMessage())->to('abc')->line('::message::');
    }

    /** @test */
    public function it_throws_exception_on_too_long_sender_()
    {
        $this->expectException(FromException::class);

        config(['46elks-notification-channel.user' => '::replace-with-test-user::']);
        config(['46elks-notification-channel.pass' => '::replace-with-test-pass']);
        config(['46elks-notification-channel.from' => 'tolongsender']);
        $sms = (new SmsMessage())->to('+461')->line('::message::');
    }

    /** @test */
    public function it_throws_exception_on_too_invalid_sender_()
    {
        $this->expectException(FromException::class);

        config(['46elks-notification-channel.user' => '::replace-with-test-user::']);
        config(['46elks-notification-channel.pass' => '::replace-with-test-pass']);
        config(['46elks-notification-channel.from' => '%abc']);
        $sms = (new SmsMessage())->to('+461')->line('::message::');
    }

    /** @test */
    public function it_throws_exception_on_empty_message_()
    {
        $this->expectException(MessageException::class);

        config(['46elks-notification-channel.user' => '::replace-with-test-user::']);
        config(['46elks-notification-channel.pass' => '::replace-with-test-pass']);
        config(['46elks-notification-channel.from' => 'sender']);
        $sms = (new SmsMessage())->to('+461');

        FortySixElks::create($sms)->dryRun()->send();
    }

    /** @test */
    public function it_throws_exception_on_empty_auth_config_()
    {
        $this->expectException(ConfigException::class);

        config(['46elks-notification-channel.from' => 'sender']);
        $sms = (new SmsMessage())->to('+461')->line('::message::');
        FortySixElks::create($sms);
    }

    /** @test */
    public function it_throws_exception_on_wrong_auth_config_()
    {
        $this->expectException(FortySixElksException::class);

        config(['46elks-notification-channel.user' => '::user::']);
        config(['46elks-notification-channel.pass' => '::pass::']);
        config(['46elks-notification-channel.from' => 'sender']);
        $sms = (new SmsMessage())->to('+461')->line('::message::');
        FortySixElks::create($sms)->dryRun()->send();
    }
}

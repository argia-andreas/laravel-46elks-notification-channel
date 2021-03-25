<?php

namespace Grafstorm\FortySixElksChannel;

use Grafstorm\FortySixElksChannel\FortySixElks as Sms;
use Illuminate\Notifications\Notification;

class FortySixElksChannel
{
    /**
     * Send notification as SMS.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     */
    public function send(mixed $notifiable, Notification $notification): void
    {
        Sms::create($notification->toFortySixElks($notifiable))->send();
    }
}

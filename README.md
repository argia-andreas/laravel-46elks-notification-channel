# 46 Elks Laravel Notification Channel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/grafstorm/laravel-46elks-notification-channel.svg?style=flat-square)](https://packagist.org/packages/grafstorm/laravel-46elks-notification-channel)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/argia-andreas/laravel-46elks-notification-channel/run-tests?label=tests)](https://github.com/argia-andreas/laravel-46elks-notification-channel/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/argia-andreas/laravel-46elks-notification-channel/Check%20&%20fix%20styling?label=code%20style)](https://github.com/argia-andreas/laravel-46elks-notification-channel/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/grafstorm/laravel-46elks-notification-channel.svg?style=flat-square)](https://packagist.org/packages/grafstorm/laravel-46elks-notification-channel)

**Disclaimer: Not a finished package! If you are looking for a finished package to user for 46elks perhaps look at: https://github.com/laravel-notification-channels/46elks**

Laravel SMS notification Channel for 46elks.se sms provider.

## Installation

You can install the package via composer:

```bash
composer require grafstorm/laravel-46elks-notification-channel
```

Be sure to set User, Password and Sender in your .env file.
Sender is limited to a alphaumeric string of maximum 11 characters([A-Za-z0-9]) or a correctly formatted [E.164](https://en.wikipedia.org/wiki/E.164) phonenumber.
```dotenv
FORTY_SIX_ELKS_USER=::username::
FORTY_SIX_ELKS_PASS=::password::
FORTY_SIX_ELKS_FROM=::sender::
```

You can publish the config file if you want to override the default settings.

```php
return [
    'user' => env('FORTY_SIX_ELKS_USER'),
    'pass' => env('FORTY_SIX_ELKS_PASS'),
    'from' => env('FORTY_SIX_ELKS_FROM', '46ELKS'),
    'base_url' => env('FORTY_SIX_ELKS_BASE_URL', 'https://api.46elks.com/a1/')
];
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Grafstorm\FortySixElksChannel\FortySixElksChannelServiceProvider" --tag="46elks-notification-channel-config"
```

## Usage

Add `Grafstorm\FortySixElksChannel\FortySixElksChannel::class` in the via method in your notification.
And be sure to add a `toFortySixElks` method that returns an array with the mobile number and the message.
```php
    use Grafstorm\FortySixElksChannel\FortySixElksChannel;
    use Grafstorm\FortySixElksChannel\SmsMessage;
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FortySixElksChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return string[]
     */
    public function toFortySixElks($notifiable): SmsMessage
    {
        // Return a SmsMessage. Needs to and message.
        // To needs to be formatted as a [E.164](https://en.wikipedia.org/wiki/E.164) phonenumber. (Eg. +4612345678)
        return (new SmsMessage())
                ->from('developer')
                ->to($notifiable->mobile)
                ->line('Hello World')
                ->line('')
                ->line('Bye world.');
    }
```

### Sending a oneoff text message
You can also use the FortySixElks facade to send a message directly in your application.
```php
use Grafstorm\FortySixElksChannel\SmsMessage;
use Grafstorm\FortySixElksChannel\Facades\FortySixElks;

$message = (new SmsMessage())
                ->to('+461')
                ->line('Hello World');
                
$sms = FortySixElks::create($message)->send();

// Use dryRun() to test sending the message.
$sms = FortySixElks::create($message)->dryRun()->send();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [grafstorm](https://github.com/argia-andreas)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

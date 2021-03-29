<?php


namespace Grafstorm\FortySixElksChannel\Validators;

use Grafstorm\FortySixElksChannel\Exceptions\MessageException;
use Illuminate\Support\Str;

class MessageValidator
{
    public static function validate(string $message): string
    {
        $isEmpty = Str::of($message)->isEmpty();
        $isTooLong = Str::of($message)->length() > 1600;

        throw_if($isEmpty, MessageException::class, 'Message can not be empty');
        throw_if($isTooLong, MessageException::class, 'Message is '. Str::of($message)->length() . ' chars, max is 1600.');

        return $message;
    }
}

<?php


namespace Grafstorm\FortySixElksChannel\Validators;

use Grafstorm\FortySixElksChannel\Exceptions\FromException;
use Illuminate\Support\Str;

class FromValidator
{
    /**
     * @param string $from
     * @return string
     * @throws \Throwable
     */
    public static function validate(string $from): string
    {
        $hasInvalidCharacters = Str::of($from)->match('/^[A-Za-z0-9]*$/')->isEmpty();
        $isTooLong = Str::of($from)->length() > 11;
        $isEmpty = Str::of($from)->trim()->isEmpty();
        $isNotValidPhoneNumber = Str::of($from)->match('/^\+[1-9]\d{1,14}$/')->isEmpty();

        throw_if(
            $isEmpty,
            FromException::class,
            'From is empty'
        );

        throw_if(
            $isNotValidPhoneNumber && $hasInvalidCharacters,
            FromException::class,
            'From has invalid characters'
        );

        throw_if(
            $isNotValidPhoneNumber && $isTooLong,
            FromException::class,
            'From is too long'
        );

        throw_if(
            $isNotValidPhoneNumber && $isTooLong,
            FromException::class,
            'From is too long'
        );

        throw_if(
            $isNotValidPhoneNumber &&
            ($hasInvalidCharacters || $isTooLong),
            FromException::class,
            'From is not a valid phonenumber'
        );

        return $from;
    }
}

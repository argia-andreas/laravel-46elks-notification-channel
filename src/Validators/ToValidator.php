<?php


namespace Grafstorm\FortySixElksChannel\Validators;

use Grafstorm\FortySixElksChannel\Exceptions\ToException;
use Illuminate\Support\Str;

class ToValidator
{
    /**
     * @param string $to
     * @return string
     * @throws \Throwable
     */
    public static function validate(string $to): string
    {
        $isNotValidPhoneNumber = Str::of($to)->match('/^\+[1-9]\d{1,14}$/')->isEmpty();

        throw_if(
            $isNotValidPhoneNumber,
            ToException::class,
            'To is not a valid phonenumber'
        );

        return $to;
    }
}

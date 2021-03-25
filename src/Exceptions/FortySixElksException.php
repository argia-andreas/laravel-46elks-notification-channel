<?php


namespace Grafstorm\FortySixElksChannel\Exceptions;

use \Exception;
use \Throwable;

class FortySixElksException extends Exception
{
    /**
     * FromException constructor.
     * @param $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

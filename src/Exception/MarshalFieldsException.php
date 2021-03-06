<?php

namespace FondOf\Airtable\Exception;

use Exception;

class MarshalFieldsException extends Exception
{
    public function __construct(string $message, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

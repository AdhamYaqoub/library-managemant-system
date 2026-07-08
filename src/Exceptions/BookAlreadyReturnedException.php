<?php

namespace App\Exceptions;

use Exception;

class BookAlreadyReturnedException extends Exception
{
    public function __construct(
        string $message = "Book is already returned."
    ) {
        parent::__construct($message);
    }
}
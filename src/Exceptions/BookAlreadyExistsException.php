<?php

namespace App\Exceptions;

use Exception;

class BookAlreadyExistsException extends Exception
{
    public function __construct(
        string $message = "Book already exists."
    ) {
        parent::__construct($message);
    }
}
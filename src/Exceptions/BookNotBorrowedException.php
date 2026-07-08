<?php

namespace App\Exceptions;

use Exception;

class BookNotBorrowedException extends Exception
{
    public function __construct(
        string $message = "This book is not borrowed by this member."
    ) {
        parent::__construct($message);
    }
}
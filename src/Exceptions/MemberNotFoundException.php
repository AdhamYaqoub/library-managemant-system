<?php

namespace App\Exceptions;

use Exception;

class MemberNotFoundException extends Exception
{
    public function __construct(
        string $message = "Member not found."
    ) {
        parent::__construct($message);
    }
}
<?php

namespace App\Exceptions;

use Exception;

class MemberAlreadyExistsException extends Exception
{
    public function __construct(
        string $message = "Member already exists."
    ) {
        parent::__construct($message);
    }
}
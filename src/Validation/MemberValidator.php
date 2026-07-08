<?php

namespace App\Validation;

use App\Classes\Member;
use App\Exceptions\ValidationException;

class MemberValidator
{
    public static function validate(Member $member): void
    {
        self::validateName($member->getName());
        self::validateEmail($member->getEmail());
    }


    private static function validateName(string $name): void
    {
        if (empty(trim($name))) {
            throw new ValidationException("Member name cannot be empty.");
        }

        if (strlen($name) < 3) {
            throw new ValidationException("Member name must contain at least 3 characters.");
        }
    }


    private static function validateEmail(string $email): void
    {
        if (empty(trim($email))) {
            throw new ValidationException("Email cannot be empty.");
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("Invalid email format.");
        }
    }
}
<?php

namespace App\Validation;

use App\Classes\Book;
use App\Exceptions\ValidationException;

class BookValidator
{
    public static function validate(Book $book): void
    {
        self::validateTitle($book->getTitle());
        self::validateAuthor($book->getAuthor());
        self::validateCategory($book->getCategory());
        self::validatePublishYear($book->getPublishYear());
    }


    private static function validateTitle(string $title): void
    {
        if (empty(trim($title))) {
            throw new ValidationException("Book title cannot be empty.");
        }

        if (strlen($title) < 2) {
            throw new ValidationException("Book title must contain at least 2 characters.");
        }
    }


    private static function validateAuthor(string $author): void
    {
        if (empty(trim($author))) {
            throw new ValidationException("Author name cannot be empty.");
        }

        if (strlen($author) < 2) {
            throw new ValidationException("Author name must contain at least 2 characters.");
        }
    }


    private static function validateCategory(string $category): void
    {
        if (empty(trim($category))) {
            throw new ValidationException("Category cannot be empty.");
        }
    }


    private static function validatePublishYear(int $year): void
    {
        $currentYear = date("Y");

        if ($year < 0 || $year > $currentYear) {
            throw new ValidationException("Invalid publish year.");
        }
    }
}
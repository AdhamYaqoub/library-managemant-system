<?php

namespace App\Classes;

use App\Exceptions\BookNotAvailableException;
use App\Exceptions\BookNotBorrowedException;

class Member
{
    private int $id;
    private string $name;
    private string $email;
    private array $borrowedBooks;


    public function __construct(
        int $id,
        string $name,
        string $email
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->borrowedBooks = [];
    }


    public function borrowBook(Book $book): void
    {
        if (!$book->isAvailable()) {
            throw new BookNotAvailableException();
        }

        $book->borrow();

        $this->borrowedBooks[] = $book;
    }


    public function returnBook(Book $book): void
    {
        foreach ($this->borrowedBooks as $key => $borrowedBook) {

            if ($borrowedBook->getId() === $book->getId()) {

                $book->returnBook();

                unset($this->borrowedBooks[$key]);

                // Re-index array
                $this->borrowedBooks = array_values($this->borrowedBooks);

                return;
            }
        }

        throw new BookNotBorrowedException();
    }


    public function getBorrowedBooks(): array
    {
        return $this->borrowedBooks;
    }


    public function getInfo(): string
    {
        return "
            ID: {$this->id}<br>
            Name: {$this->name}<br>
            Email: {$this->email}<br>
            Borrowed Books Count: " . count($this->borrowedBooks);
    }


    // Getters

    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    // Setters

    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
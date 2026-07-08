<?php

namespace App\Classes;

use App\Validation\BookValidator;
use App\Validation\MemberValidator;

use App\Exceptions\BookNotFoundException;
use App\Exceptions\BookAlreadyExistsException;
use App\Exceptions\MemberAlreadyExistsException;
use App\Exceptions\MemberNotFoundException;

class Library
{
    private array $books;
    private array $members;


    public function __construct()
    {
        $this->books = [];
        $this->members = [];
    }


    public function addBook(Book $book): void
    {
        BookValidator::validate($book);

        foreach ($this->books as $existingBook) {

            if ($existingBook->getId() === $book->getId()) {
                throw new BookAlreadyExistsException();
            }
        }

        $this->books[] = $book;
    }


    public function removeBook(int $id): void
    {
        foreach ($this->books as $key => $book) {

            if ($book->getId() === $id) {

                unset($this->books[$key]);

                // Re-index array
                $this->books = array_values($this->books);

                return;
            }
        }

        throw new BookNotFoundException();
    }


    public function addMember(Member $member): void
    {
        MemberValidator::validate($member);

        foreach ($this->members as $existingMember) {

            if ($existingMember->getId() === $member->getId()) {
                throw new MemberAlreadyExistsException();
            }
        }

        $this->members[] = $member;
    }


    public function searchBookByTitle(string $title): array
    {
        $results = [];

        foreach ($this->books as $book) {

            if (stripos($book->getTitle(), $title) !== false) {
                $results[] = $book;
            }
        }

        return $results;
    }


    public function searchBookByCategory(string $category): array
    {
        $results = [];

        foreach ($this->books as $book) {

            if (stripos($book->getCategory(), $category) !== false) {
                $results[] = $book;
            }
        }

        return $results;
    }


    public function displayBooks(): array
    {
        return $this->books;
    }


    public function getBooks(): array
    {
        return $this->books;
    }


    public function getMembers(): array
    {
        return $this->members;
    }


    public function findBookById(int $id): Book
    {
        foreach ($this->books as $book) {

            if ($book->getId() === $id) {
                return $book;
            }
        }

        throw new BookNotFoundException();
    }


    public function findMemberById(int $id): Member
    {
        foreach ($this->members as $member) {

            if ($member->getId() === $id) {
                return $member;
            }
        }

        throw new MemberNotFoundException();
    }
}
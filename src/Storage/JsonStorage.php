<?php

namespace App\Storage;

use App\Classes\Book;
use App\Classes\Member;

class JsonStorage
{
    private string $filePath;


    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;

        // Create file if not exists
        if (!file_exists($this->filePath)) {

            file_put_contents(
                $this->filePath,
                json_encode([
                    "books" => [],
                    "members" => []
                ], JSON_PRETTY_PRINT)
            );
        }
    }


    public function save(array $books, array $members): void
    {
        $data = [
            "books" => [],
            "members" => []
        ];


        foreach ($books as $book) {

            $data["books"][] = [
                "id" => $book->getId(),
                "title" => $book->getTitle(),
                "author" => $book->getAuthor(),
                "category" => $book->getCategory(),
                "publishYear" => $book->getPublishYear(),
                "isAvailable" => $book->isAvailable()
            ];
        }


        foreach ($members as $member) {

            $borrowedBooks = [];

            foreach ($member->getBorrowedBooks() as $book) {
                $borrowedBooks[] = $book->getId();
            }


            $data["members"][] = [
                "id" => $member->getId(),
                "name" => $member->getName(),
                "email" => $member->getEmail(),
                "borrowedBooks" => $borrowedBooks
            ];
        }


        file_put_contents(
            $this->filePath,
            json_encode($data, JSON_PRETTY_PRINT)
        );
    }


    public function load(): array
    {
        $content = file_get_contents($this->filePath);

        return json_decode($content, true);
    }
}
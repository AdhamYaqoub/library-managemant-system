<?php

namespace App\Classes;

//use Exception;
use App\Exceptions\BookNotAvailableException;
use App\Exceptions\BookAlreadyReturnedException;
class Book
{
    private int $id;
    private string $title;
    private string $author;
    private string $category;
    private int $publishYear;
    private bool $isAvailable;


    public function __construct(
        int $id,
        string $title,
        string $author,
        string $category,
        int $publishYear
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->publishYear = $publishYear;
        $this->isAvailable = true;
    }


    public function borrow(): void
    {
        if (!$this->isAvailable) {
            throw new BookNotAvailableException();
        }

        $this->isAvailable = false;
    }


    public function returnBook(): void
    {
        if ($this->isAvailable) {
            throw new BookAlreadyReturnedException();
        }

        $this->isAvailable = true;
    }


    public function getInfo(): string
    {
        return "
            ID: {$this->id}<br>
            Title: {$this->title}<br>
            Author: {$this->author}<br>
            Category: {$this->category}<br>
            Publish Year: {$this->publishYear}<br>
            Status: " . ($this->isAvailable ? "Available" : "Borrowed");
    }


    // Getters

    public function getId(): int
    {
        return $this->id;
    }


    public function getTitle(): string
    {
        return $this->title;
    }


    public function getAuthor(): string
    {
        return $this->author;
    }


    public function getCategory(): string
    {
        return $this->category;
    }


    public function getPublishYear(): int
    {
        return $this->publishYear;
    }


    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }


    // Setters

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }


    public function setCategory(string $category): void
    {
        $this->category = $category;
    }


    public function setPublishYear(int $publishYear): void
    {
        $this->publishYear = $publishYear;
    }
}
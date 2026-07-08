<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Classes\Book;
use App\Classes\Member;
use App\Classes\Library;

use App\Exceptions\BookNotAvailableException;
use App\Exceptions\BookNotFoundException;
use App\Exceptions\BookAlreadyExistsException;
use App\Exceptions\MemberAlreadyExistsException;


class LibraryTest
{
    private Library $library;
    private Book $book;
    private Member $member;


    public function setUp(): void
    {
        $this->library = new Library();


        $this->book = new Book(
            1,
            "Clean Code",
            "Robert Martin",
            "Programming",
            2008
        );


        $this->member = new Member(
            1,
            "AdhamYaqoub",
            "eng.adhamyaqoub@gmail.com"
        );


        $this->library->addBook($this->book);
        $this->library->addMember($this->member);
    }



    public function testAddBook(): void
    {
        $books = $this->library->getBooks();

        assert(
            count($books) === 1,
            "Book was not added"
        );
    }



    public function testBorrowBook(): void
    {
        $this->member->borrowBook($this->book);

        assert(
            !$this->book->isAvailable(),
            "Book should be borrowed"
        );
    }



    public function testReturnBook(): void
    {
        $this->member->borrowBook($this->book);

        $this->member->returnBook($this->book);

        assert(
            $this->book->isAvailable(),
            "Book should be available"
        );
    }



    public function testSearchBookByTitle(): void
    {
        $result = $this->library
            ->searchBookByTitle("Clean");


        assert(
            count($result) === 1,
            "Search failed"
        );
    }



    public function testCannotBorrowUnavailableBook(): void
    {
        try {

            $this->member->borrowBook($this->book);

            $this->member->borrowBook($this->book);


            assert(false, "Exception was not thrown");


        } catch (BookNotAvailableException $e) {

            assert(true);
        }
    }



    public function testDuplicateBook(): void
    {
        try {

            $duplicateBook = new Book(
                1,
                "Another Book",
                "Author",
                "Category",
                2020
            );


            $this->library->addBook($duplicateBook);


            assert(false, "Exception was not thrown");


        } catch (BookAlreadyExistsException $e) {

            assert(true);
        }
    }



    public function testRemoveBook(): void
    {
        $this->library->removeBook(1);


        assert(
            count($this->library->getBooks()) === 0,
            "Book was not removed"
        );
    }



    public function run(): void
    {
        $tests = [
            "testAddBook",
            "testBorrowBook",
            "testReturnBook",
            "testSearchBookByTitle",
            "testCannotBorrowUnavailableBook",
            "testDuplicateBook",
            "testRemoveBook"
        ];


        foreach ($tests as $test) {

            $this->setUp();


            try {

                $this->$test();

                echo "✔ {$test} Passed<br>";

            } catch (\Throwable $e) {

                echo "✘ {$test} Failed: ";
                echo $e->getMessage();
                echo "<br>";
            }
        }
    }
}



$test = new LibraryTest();

$test->run();
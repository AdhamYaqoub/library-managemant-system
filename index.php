<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Classes\Book;
use App\Classes\Member;
use App\Classes\Library;

use App\Storage\JsonStorage;

use App\Exceptions\BookNotAvailableException;
use App\Exceptions\ValidationException;

use App\Services\BookSorter;
use App\Services\LibraryStatistics;
use App\Services\Pagination;


try {

    // Create Storage
    $storage = new JsonStorage(
        __DIR__ . "/data/library.json"
    );


    // Create Library
    $library = new Library();



    // Create Books

    $book1 = new Book(
        1,
        "Clean Code",
        "Robert Martin",
        "Programming",
        2008
    );


    $book2 = new Book(
        2,
        "The Pragmatic Programmer",
        "David Thomas",
        "Programming",
        1999
    );



    // Create Member

    $member1 = new Member(
        1,
        "AdhamYaqoub",
        "eng.adhamyaqoub@gmail.com"
    );



    // Add Books

    $library->addBook($book1);
    $library->addBook($book2);



    // Add Member

    $library->addMember($member1);



    // Display All Books

    echo "=== All Books ===<br><br>";

    foreach ($library->displayBooks() as $book) {

        echo $book->getInfo();
        echo "<br><br>";
    }



    // Borrow Book

    echo "=== Borrow Book ===<br><br>";

    $member1->borrowBook($book1);

    echo $book1->getInfo();



    // Display Borrowed Books

    echo "<br><br>=== Borrowed Books ===<br><br>";

    foreach ($member1->getBorrowedBooks() as $book) {

        echo $book->getInfo();
        echo "<br><br>";
    }



    // Search By Title

    echo "=== Search Result ===<br><br>";

    $results = $library->searchBookByTitle("Clean");


    foreach ($results as $book) {

        echo $book->getInfo();
        echo "<br><br>";
    }



    // Save Data To JSON

    $storage->save(
        $library->getBooks(),
        $library->getMembers()
    );


    echo "<br><br>=== Data Saved Successfully ===<br><br>";



    // Load JSON Data

    // $data = $storage->load();


    // echo "<br><br>=== Loaded JSON Data ===<br><br>";

    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";


    echo "=== Sorted By Title ===<br><br>";

$sortedBooks = BookSorter::sortByTitle(
    $library->getBooks()
);

foreach ($sortedBooks as $book) {
    echo $book->getInfo();
    echo "<br><br>";
}


echo "=== Library Statistics ===<br><br>";

$statistics = LibraryStatistics::generate(
    $library->getBooks(),
    $library->getMembers()
);


echo "Total Books: " . $statistics["totalBooks"] . "<br>";
echo "Available Books: " . $statistics["availableBooks"] . "<br>";
echo "Borrowed Books: " . $statistics["borrowedBooks"] . "<br>";
echo "Total Members: " . $statistics["totalMembers"] . "<br>";



echo "=== Page 1 ===<br><br>";

$pageBooks = Pagination::paginate(
    $library->getBooks(),
    1,
    2
);


foreach ($pageBooks as $book) {
    echo $book->getInfo();
    echo "<br><br>";
}



} catch (
    BookNotAvailableException |
    ValidationException $e
) {

    echo "Error: " . $e->getMessage();

}
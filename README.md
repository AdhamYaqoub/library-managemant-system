# Library Management System

## Overview

Library Management System is a PHP console/web-based application developed using Object-Oriented Programming (OOP) principles.

The system allows managing books and library members, borrowing and returning books, searching books, displaying library data, and storing data using JSON persistence.

---

## Features

### Core Features

* Add books to the library
* Remove books from the library
* Add members
* Borrow books
* Return books
* Search books by title
* Search books by category
* Display all books
* Display borrowed books

### Validation

* Validate book title
* Validate author name
* Validate category
* Validate publish year
* Validate member name
* Validate email address

### Error Handling

Custom exceptions are implemented for:

* Book not available
* Book already returned
* Book not found
* Book already exists
* Book not borrowed
* Member not found
* Member already exists
* Validation errors

### Bonus Features

* JSON Persistence
* Sorting books by title
* Sorting books by publish year
* Library statistics
* Pagination

---

## Project Structure

```text
library-management-system/

├── src/
│   ├── Classes/
│   │   ├── Book.php
│   │   ├── Member.php
│   │   └── Library.php
│   │
│   ├── Exceptions/
│   │
│   ├── Validation/
│   │   ├── BookValidator.php
│   │   └── MemberValidator.php
│   │
│   ├── Storage/
│   │   └── JsonStorage.php
│   │
│   └── Services/
│       ├── BookSorter.php
│       ├── LibraryStatistics.php
│       └── Pagination.php
│
├── data/
│   └── library.json
│
├── tests/
│   └── LibraryTest.php
│
├── index.php
├── composer.json
└── README.md
```

---

## Technologies Used

* PHP 8+
* Object-Oriented Programming (OOP)
* Composer Autoloading
* JSON Storage
* Custom Exceptions

---

## Installation

Clone the repository:

```bash
git clone <https://github.com/AdhamYaqoub/library-managemant-system>
```

Navigate to the project folder:

```bash
cd library-management-system
```

Install dependencies:

```bash
composer install
```

---

## Running the Application

Run the application:

```bash
php index.php
```

Or using PHP built-in server:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000
```

---

## Running Tests

Execute the test file:

```bash
php tests/LibraryTest.php
```

Expected output:

```text
✔ testAddBook Passed
✔ testBorrowBook Passed
✔ testReturnBook Passed
✔ testSearchBookByTitle Passed
✔ testCannotBorrowUnavailableBook Passed
✔ testDuplicateBook Passed
✔ testRemoveBook Passed
```

---

## Statistics

The system provides:

* Total number of books
* Available books count
* Borrowed books count
* Total members count

---

## Sorting

Books can be sorted by:

* Title
* Publish Year

---

## Pagination

Books can be displayed using pagination by specifying:

* Page number
* Items per page

---

## Author

Adham Yaqoub

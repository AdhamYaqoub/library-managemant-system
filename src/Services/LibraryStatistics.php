<?php

namespace App\Services;

class LibraryStatistics
{

    public static function generate(
        array $books,
        array $members
    ): array {

        $available = 0;
        $borrowed = 0;


        foreach ($books as $book) {

            if ($book->isAvailable()) {

                $available++;

            } else {

                $borrowed++;

            }
        }


        return [

            "totalBooks" => count($books),

            "availableBooks" => $available,

            "borrowedBooks" => $borrowed,

            "totalMembers" => count($members)

        ];
    }

}
<?php

namespace App\Services;

class BookSorter
{

    public static function sortByTitle(array $books): array
    {
        usort($books, function ($a, $b) {

            return strcmp(
                $a->getTitle(),
                $b->getTitle()
            );

        });

        return $books;
    }



    public static function sortByPublishYear(array $books): array
    {
        usort($books, function ($a, $b) {

            return $a->getPublishYear()
                <=>
                $b->getPublishYear();

        });

        return $books;
    }

}
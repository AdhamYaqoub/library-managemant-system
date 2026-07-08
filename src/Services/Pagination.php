<?php

namespace App\Services;

class Pagination
{

    public static function paginate(
        array $items,
        int $page,
        int $perPage
    ): array {


        $offset = ($page - 1) * $perPage;


        return array_slice(
            $items,
            $offset,
            $perPage
        );

    }



    public static function totalPages(
        array $items,
        int $perPage
    ): int {

        return ceil(
            count($items) / $perPage
        );

    }

}
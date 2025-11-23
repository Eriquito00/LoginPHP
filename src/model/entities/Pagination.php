<?php
namespace App\Model\Entities;

class Pagination {
        public function __construct(
            public array $items,
            public int $actualPage,
            public bool $hasNext,
            public bool $hasPrev,
            public int $totalPages,
            public int $totalItems
        ) {}
    }
?>
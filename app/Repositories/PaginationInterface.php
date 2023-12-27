<?php

namespace App\Repositories;

interface PaginationInterface
{
    public function items(): array;
    public function links();
    public function total(): int;
    public function currentPage(): int;
    public function firstPage(): int;
    public function lastPage(): int;
    public function pageName(): string;
    public function path(): string;
    public function perPage(): int;
}

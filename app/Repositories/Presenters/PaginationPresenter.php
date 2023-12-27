<?php

namespace App\Repositories\Presenters;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\PaginationInterface;
use stdClass;
class PaginationPresenter implements PaginationInterface
{
    public function __construct(
        private LengthAwarePaginator $paginator
    ) {
    }

    public function items(): array
    {
        return $this->paginator->items();
    }
    public function links()
    {
        return $this->paginator->links();
    }
    public function perPage(): int
    {
        return $this->paginator->perPage() ?? 0;
    }
    public function total(): int
    {
        return $this->paginator->total() ?? 0;
    }

    public function currentPage(): int
    {
        return $this->paginator->currentPage() ?? 1;
    }

    public function lastPage(): int
    {
        return $this->paginator->lastPage() ?? 0;
    }

    public function firstPage(): int
    {
        return $this->paginator->firstItem() ?? 0;
    }
    public function pageName(): string
    {
        return $this->paginator->getPageName() ?? '';
    }
    public function path(): string
    {
        return $this->paginator->path() ?? '';
    }
}

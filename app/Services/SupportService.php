<?php

namespace App\Services;

use App\Repositories\SupportRepositoryInterface;

class SupportService
{
    private $repository;

    public function __construct(SupportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function paginate(
        int $page = 1,
        int $totalPerPage = 15,
        string $filter = null
    ): PaginationInterface {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter,
        );
    }
    public function getSupports(string $status = 'P', int $page = 1)
    {
        return $this->repository->getByStatus(
            status: $status,
            page: $page,
        );
    }

    public function getSupport(string $id): object|null
    {
        return $this->repository->findById($id);
    }

}

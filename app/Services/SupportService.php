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

    public function getSupports(string $status = 'P'): array
    {
        $supports = $this->repository->getByStatus($status);

        return converItemsOfArrayToObject($supports);
    }

    public function getSupport(string $id): object|null
    {
        return $this->repository->findById($id);
    }

}
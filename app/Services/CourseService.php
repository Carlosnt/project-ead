<?php

namespace App\Services;

use App\Repositories\CourseRepositoryInterface;

class CourseService
{
    private $repository;

    public function __construct(CourseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = '', int $page = 1)
    {
        return $this->repository->getAll(
            filter: $filter,
            page: $page
        );
    }

    public function findById(string $id): object|null
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): object|null
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): object|null
    {
        return $this->repository->update($id, $data);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}

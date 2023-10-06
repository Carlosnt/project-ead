<?php 

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;


class CategoryService
{
    private $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = ''): array
    {
        $users = $this->repository->getAll($filter);

        return converItemsOfArrayToObject($users);
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
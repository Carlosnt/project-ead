<?php 

namespace App\Services;

use App\Repositories\ModuleRepositoryInterface;

class ModuleService
{
    private $repository;

    public function __construct(ModuleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = ''): array
    {
        $modules = $this->repository->getAll($filter);

        return converItemsOfArrayToObject($modules);
    }

    public function findById(string $id): object|null
    {
        return $this->repository->findById($id);
    }

    public function getModule(string $id): object|null
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
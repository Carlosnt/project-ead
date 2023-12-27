<?php
namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function getAllCourses();
    public function getAll(string $filter = '', int $page): PaginationInterface;
    public function findById(string $id): object|null;
    public function create(array $data): object;
    public function update(string $id, array $data): object|null;
    public function delete(string $id): bool;
}

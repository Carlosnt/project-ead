<?php
namespace App\Repositories;

interface CourseRepositoryInterface
{
    public function getAllCourses();
    public function getCourse(string $identify);
    public function getAll(string $filter = '', int $page): PaginationInterface;
    public function findById(string $id): object|null;
    public function create(array $data): object;
    public function update(string $id, array $data): object|null;
    public function delete(string $id): bool;
}

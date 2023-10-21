<?php
namespace App\Repositories;

interface LessonRepositoryInterface
{
    //public function getLessonsByModuleId( string $moduleId): array;
    public function getAllByModuleId(string $moduleId, string $filter = ''): array;
    public function findById(string $id): object|null;    
    public function createByModule(string $moduleId, array $data): object;
    public function update(string $id, array $data): object|null;
    public function delete(string $id): bool;
    public function markLessonViewed(string $lessonId);
}
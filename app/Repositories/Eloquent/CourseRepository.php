<?php 

namespace App\Repositories\Eloquent;

use App\Models\Course as Model;
use App\Repositories\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllCourses()
    {
        return $this->model->with('modules.lessons.views')->get();
    }

    public function getCourse(string $identify)
    {
        return $this->model->with('modules.lessons')->findOrFail($identify);
    }

    public function getAll(string $filter = ''): array
    {
        $crouses = $this->model
                        ->where(function ($query) use ($filter) {
                            if ($filter) {
                                $query->where('name', 'LIKE', "%{$filter}%");
                            }
                        })
                        ->get();

        return $crouses->toArray();
    }

    public function findById(string $id): object
    {
        return $this->model->find($id);
    }

    public function create(array $data): object
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): object|null
    {
       if(!$course = $this->findById($id)){
            return null;
       }

       $course->update($data);

       return $course;

    }

    public function delete(string $id): bool
    {
        if(!$course = $this->findById($id)){
            return false;
        }

        return $course->delete();
    }
}
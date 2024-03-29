<?php

namespace App\Repositories\Eloquent;

use App\Models\Category as Model;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\StatusRepositoryInterface;

class StatusRepository implements StatusRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function getAll(string $filter = ''): array
    {
        $crouses = $this->model
                        ->where(function ($query) use ($filter) {
                            if ($filter) {
                                $query->where('name', 'LIKE', "%{$filter}%");
                            }
                        })

                        ->withCount(['supports'])
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

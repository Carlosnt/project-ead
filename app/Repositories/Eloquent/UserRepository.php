<?php

namespace App\Repositories\Eloquent;

use App\Models\User as Model;
use App\Repositories\PaginationInterface;
use App\Repositories\Presenters\PaginationPresenter;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = '', int $page): PaginationInterface
    {
        $users = $this->model
                        ->where(function ($query) use ($filter) {
                            if ($filter) {
                                $query->where('email', $filter);
                                $query->orWhere('name', 'LIKE', "%{$filter}%");
                            }
                        })
                        ->paginate()->withQueryString();

        return new PaginationPresenter($users);
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
       if(!$user = $this->findById($id)){
            return null;
       }

       $user->update($data);

       return $user;

    }

    public function delete(string $id): bool
    {
        if(!$user = $this->findById($id)){
            return false;
        }

        return $user->delete();
    }
}

<?php
namespace App\Repositories\Eloquent;

use App\Models\Support as Model;
use App\Repositories\SupportRepositoryInterface;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository implements SupportRepositoryInterface
{
    use RepositoryTrait;

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getByStatus(string $status): array
    {
        $lessons = $this->model
                        ->where('status', $status) 
                        ->with(['user', 'lesson'])                           
                        ->get();

        return $lessons->toArray();
    }

     public function findById(string $id): object
    {
        return $this->model
                        ->with(['user','admin','lesson','replies'])
                        ->find($id);
    }

    /*public function getMySupports(array $filters = [])
    {
        $filters['user'] = true;

        return $this->getSupports($filters);
    }

    public function getSupports(array $filters = [])
    {
        return $this->entity
            ->where(function ($query) use ($filters){
                if(isset($filters['lesson'])){
                    $query->where('lesson_id', $filters['lesson']);
                }

                if(isset($filters['status'])){
                    $query->where('status', $filters['status']);
                }

                if(isset($filters['filter'])){
                    $filter = $filters['filter'];
                    $query->where('description', 'LIKE', "%{$filter}%");
                }

                if(isset($filters['status'])){
                    $user = $this->getUserAuth();
                    $query->where('user_id', $user->id);
                }
            })
            ->with('replies')
            ->orderBy('updated_at')
            ->get();
    }

    public function getSupportByUserId(string $identify)
    {
        return $this->entity->findOrFail($identify);
    }

    public function createNewSupport(array $data): Support
    {
        $support = $this->getUserAuth()
            ->supports()
            ->create([
                'lesson_id' => $data['lesson'],
                'description' => $data['description'],
                'status' => $data['status'],
            ]);

        return $support;
    }

    public function createReplyToSupportId($supportId, array $data)
    {
        $user = $this->getUserAuth();

        return $this->getSupport($supportId)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id,
            ]);
    }

    private function getSupport(string $id)
    {
        return $this->entity->findOrFail($id);
    }*/

}

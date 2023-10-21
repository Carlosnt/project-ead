<?php
namespace App\Repositories\Eloquent;

use App\Models\Lesson as Model;
use App\Repositories\LessonRepositoryInterface;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository implements LessonRepositoryInterface
{
    use RepositoryTrait;

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllByModuleId(string $moduleId, string $filter = ''): array
    {
        $lessons = $this->model
                        ->where(function ($query) use ($filter) {
                            if ($filter) {
                                $query->where('name', 'LIKE', "%{$filter}%");
                            }
                        })
                        ->where('module_id', $moduleId)
                        ->get();

        return $lessons->toArray();
    }

    public function findById(string $id): object
    {
        return $this->model->find($id);
    }
   

    public function createByModule(string $moduleId, array $data): object
    {
        $data['module_id'] = $moduleId;
        return $this->model->create($data);
    }

    public function update(string $id, array $data): object|null
    {
        if (!$itemDb = $this->findById($id)) {
            return null;
        }

        $itemDb->update($data);

        return $itemDb;
    }

    public function delete(string $id): bool
    {
        if(!$lesson = $this->findById($id)){
            return false;
        }

        return $lesson->delete();
    }
    /*public function getLessonsByModuleId(string $moduleId): array
    {
        return $this->model
            ->where('module_id', $moduleId)
            ->with('supports.replies')
            ->get();
    }

    public function getLesson(string $id): object
    {
        return $this->model->findOrFail($id);
    }
    */
    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id', $lessonId)->first();

        if($view){
            $view->update([
                'qty' => $view->qty + 1,
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);
    }
    
}

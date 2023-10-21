<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Repositories\LessonRepositoryInterface;
use App\Repositories\ModuleRepositoryInterface;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    protected $repository;
    protected $repositoryModule;

    public function __construct(
        ModuleRepositoryInterface $repositoryModule,
        LessonRepositoryInterface $repository)
    {
        $this->repositoryModule = $repositoryModule;
        $this->repository = $repository;
    }

    public function index(Request $request, $moduleId)
    {
        if (!$module = $this->repositoryModule->findById($moduleId))
        return back();

        $data = $this->repository->getAllByModuleId(
            moduleId: $moduleId,
            filter: $request->filter ?? ''
        );
        $lessons = converItemsOfArrayToObject($data);

        return Inertia::render('Admin/Courses/Lessons/Index-lessons', [
            'lessons' => $lessons,
            'module' => $module
        ]);
    }

    public function create($moduleId)
    {
        if (!$module = $this->repositoryModule->findById($moduleId))
            return back();

        return Inertia::render('Admin/Courses/Lessons/Create',[
            'module' => $module
        ]);
    }

    public function store(LessonRequest $request, $moduleId)
    {
        if (!$this->repositoryModule->findById($moduleId))
        return back();
       
        $lesson = $this->repository->createByModule($moduleId, $request->all());

        if(!$lesson){
            return back()->with('error','Opps!, Erro ao Cadastrar a aula.');
        }

        return redirect()->route('admin.lessons.index', $moduleId);
        
    }

    public function edit($moduleId, $id)
    {
        if (!$module = $this->repositoryModule->findById($moduleId))
            return back();

        if (!$lesson = $this->repository->findById($id))
            return back();   

        return Inertia::render('Admin/Courses/Lessons/Edit', [
            'module' => $module,
            'lesson' => $lesson,
        ]);
    }

    public function update(LessonRequest $request, $moduleId, $id)
    {
        if (!$this->repositoryModule->findById($moduleId))
        return back();
    
        if(!$this->repository->update($id, $request->all())){
            return back()->with('error','Opps!, Erro ao atualizar a aula.');
        }

        return redirect()->route('admin.lessons.index', $moduleId)->with('success','Pronto!, Aula atualizada com sucesso.');
        
    }

    public function show($moduleId, $id)
    {
        if (!$module = $this->repositoryModule->findById($moduleId))
        return back();

        if (!$lesson = $this->repository->findById($id))
            return back();   

        return Inertia::render('Admin/Courses/Lessons/Show', [
            'lesson' => $lesson,
            'module' => $module
        ]);
    }

    public function destroy($moduleId, $id)
    {
        if($this->repository->delete($id)){
            return redirect()->route('admin.lessons.index', $moduleId)->with('success','Pronto!, Aula deletada com sucesso.');
        }else{
            return redirect()->route('admin.lessons.index', $moduleId)->with('error','Opps!, Erro ao deletar a aula.');
        }
    }
    
}

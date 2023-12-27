<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Models\Module;
use App\Models\Course;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\ModuleRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModuleController extends Controller
{
    protected $repository;
    protected $repositoryCourse;

    public function __construct(
        CourseRepositoryInterface $repositoryCourse,
        ModuleRepositoryInterface $repository
    ) {
        $this->repositoryCourse = $repositoryCourse;
        $this->repository = $repository;
    }

    public function index(Request $request, $courseId)
    {
        if (!$course = $this->repositoryCourse->findById($courseId))
            return back();

        $modules = $this->repository->getAllByCourseId(
            courseId: $courseId,
            filter: $request->filter ?? '',
            page: (int) $request->get('page', 1),
        );

        $array = new \stdClass();
        $array->data =  $modules->links();
        $ar = (object) $array->data->getData();
        $array->getData =  $ar;
        $array->getLinks = $array->getData->paginator;
        $array->setLinks = $array->getLinks;
        $data = (object) $array->setLinks;

        return Inertia::render('Admin/Courses/Modules/Index-modules', [
            'course' => $course,
            'modules' => $data
        ]);
    }

    public function moduleCourse(string $courseId){

        $courses = Course::where('avaialble','=', 1)->get();
        $course = Course::findOrFail($courseId);
        return Inertia::render('Admin/Modules/Module-course',[
            'course' => $course,
            'courses' => $courses
        ]);
    }

    public function create()
    {
        $courses = Course::where('avaialble','=', 1)->get();

        return Inertia::render('Admin/Modules/Create',[
            'courses' => $courses,
        ]);
    }

    public function store(ModuleRequest $request, $courseId)
    {
        if (!$this->repositoryCourse->findById($courseId))
        return back();

        $module = $this->repository->createByCourse($courseId, $request->only(['name']));

        if(!$module){
            return back()->with('error','Opps!, Erro ao Cadastrar o módulo.');
        }

        return redirect()->route('admin.modules.index', $courseId);
    }

    public function edit($courseId, $id)
    {
        if (!$course = $this->repositoryCourse->findById($courseId))
            return back();

        if (!$module = $this->repository->findById($id))
            return back();

        $module = Module::findOrFail($module->id);
        return Inertia::render('Admin/Modules/Edit', [
            'module' => $module,
            'course' => $course,
        ]);
    }

    public function update(ModuleRequest $request, $courseId, $id)
    {
        if (!$this->repositoryCourse->findById($courseId))
        return back();

        if(!$this->repository->update($id, $request->only('name'))){
            return back()->with('error','Opps!, Erro ao atualizar o módulo.');
        }

        return redirect()->route('admin.modules.index', $courseId)->with('success','Pronto!, Módulo atualizado com sucesso.');
    }

    public function show($courseId, $id)
    {
        if (!$course = $this->repositoryCourse->findById($courseId))
            return back();

        if (!$module = $this->repository->findById($id))
            return back();

        return Inertia::render('Admin/Modules/Edit', [
            'module' => $module,
            'course' => $course
        ]);
    }

    public function destroy($courseId, $id)
    {
        if($this->repository->delete($id)){
            return redirect()->route('admin.modules.index', $courseId)->with('success','Pronto!, Módulo deletado com sucesso.');
        }else{
            return redirect()->route('admin.modules.index', $courseId)->with('error','Opps!, Erro ao deletar o módulo.');
        }
    }

}

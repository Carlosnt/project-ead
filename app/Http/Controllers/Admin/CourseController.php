<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Services\UploadFile;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    private $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        $courses = $this->service->getAll(
            filter: $request->filter ?? ""
        );
        return Inertia::render('Admin/Courses/Index', [
            'courses' => $courses,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Admin/Courses/Create',[
            "categories" => $categories
        ]);
    }

    public function store(CourseRequest $request)
    {
        $data = $request->all();
       dd($data);
        $course = $this->service->create($data);

        if(!$course){
            return back()->with('error','Opps!, Erro ao Cadastrar o curso.');
        }

        return redirect()->route('admin.courses.index')->with('success','Pronto!, Curso cadastrado com sucesso.');
    }

    public function edit(Course $course)
    {
        $course = Course::findOrFail($course->id);
        return Inertia::render('Admin/Admins/Edit', [
            'course' => $course,
        ]);
    }

    public function update(CourseRequest $request, $id)
    {
        $data = $request->all();

        if(!$this->service->update($id, $data)){
            return back()->with('error','Opps!, Erro ao atualizar o curso.');
        }

        return redirect()->route('admin.courses.index')->with('success','Pronto!, Curso atualizado com sucesso.');
    }

    public function show(Course $course)
    {
        $course = Course::findOrFail($course->id);
        return Inertia::render('Admin/Courses/Edit', [
            'course' => $course,
        ]);
    }

    public function destroy(Course $course)
    {
        $course = Course::findOrFail($course->id);
        $uploadFile = new UploadFile(); 
        if ($course) {             
            $uploadFile->removeFile($course->image);
        }
       
        if($course->destroy($course->id)){
            return redirect()->route('admin.courses.index')->with('success','Pronto!, Curso deletado com sucesso.');
        }else{
            return redirect()->route('admin.coureses.index')->with('error','Opps!, Erro ao deletar o curso.');
        }
    }

    public function uploadFile(Request $request, UploadFile $uploadFile, $id)
    {
        $adminUpdate = Course::FindOrFail($id);
      
        if($request->hasFile('image')){
            if ($adminUpdate->image != null) {             
                $uploadFile->removeFile($adminUpdate->image);
                $adminUpdate->image = '';
                $adminUpdate->save();
            }
        }        

        $path = $uploadFile->store($request->image, 'admins');

        if(!$this->service->update($id, ['image' => $path])){
            return back()->with('error','Opps!, Erro ao atualizar a foto curso.');
        }

        return redirect()->route('admin.courses.index')->with('success','Pronto!, Foto atualizada com sucesso.');
    }
    
}

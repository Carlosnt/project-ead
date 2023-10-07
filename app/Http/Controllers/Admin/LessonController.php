<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    private $service;

    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        $categories = $this->service->getAll(
            filter: $request->filter ?? ""
        );
        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(LessonRequest $request)
    {
        $data = $request->validated();
        $user = $this->service->create($data);

        if(!$user){
            return back()->with('error','Opps!, Erro ao Cadastrar o categoria.');
        }

        return redirect()->route('admin.categories.index')->with('success','Pronto!, Categoria cadastrada com sucesso.');
    }

    public function edit(Lesson $category)
    {
        $category = Lesson::findOrFail($category->id);
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function update(LessonRequest $request, $id)
    {

        $data = $request->all();
    
        if(!$this->service->update($id, $data)){
            return back()->with('error','Opps!, Erro ao atualizar o usuário.');
        }

        return redirect()->route('admin.categories.index')->with('success','Pronto!, Usuário atualizado com sucesso.');
    }

    public function show(Lesson $category)
    {
        $category = Lesson::findOrFail($category->id);
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function destroy(Lesson $category)
    {
        $category = Lesson::findOrFail($category->id);
    
        if($category->destroy($category->id)){
            return redirect()->route('admin.categories.index')->with('success','Pronto!, Usuário deletado com sucesso.');
        }else{
            return redirect()->route('admin.categories.index')->with('error','Opps!, Erro ao deletar o usuário.');
        }
    }
    
}

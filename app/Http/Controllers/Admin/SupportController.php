<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Services\UploadFile;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupportController extends Controller
{
    private $service;

    public function __construct(UserService $service)
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

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = $this->service->create($data);

        if(!$user){
            return back()->with('error','Opps!, Erro ao Cadastrar o usuário.');
        }

        return redirect()->route('admin.categories.index')->with('success','Pronto!, Departamento cadastrado com sucesso.');
    }

    public function edit(Category $category)
    {
        $category = Category::findOrFail($category->id);
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {

        $data = $request->all();
    
        if(!$this->service->update($id, $data)){
            return back()->with('error','Opps!, Erro ao atualizar o usuário.');
        }

        return redirect()->route('admin.categories.index')->with('success','Pronto!, Usuário atualizado com sucesso.');
    }

    public function show(Category $category)
    {
        $category = Category::findOrFail($category->id);
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);
    
        if($category->destroy($category->id)){
            return redirect()->route('admin.categories.index')->with('success','Pronto!, Usuário deletado com sucesso.');
        }else{
            return redirect()->route('admin.categories.index')->with('error','Opps!, Erro ao deletar o usuário.');
        }
    }
    
}

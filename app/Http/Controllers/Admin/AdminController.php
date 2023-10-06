<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Services\UploadFile;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    private $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;
    }
    
    public function index(Request $request)
    {
        $admins = $this->service->getAll(
            filter: $request->filter ?? ""
        );
        return Inertia::render('Admin/Admins/Index', [
            'admins' => $admins,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Admins/Create');
    }

    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $admin = $this->service->create($data);

        if(!$admin){
            return back()->with('error','Opps!, Erro ao Cadastrar o usuário.');
        }

        return redirect()->route('admin.admins.index')->with('success','Pronto!, Administrador cadastrado com sucesso.');
    }

    public function edit(Admin $admin)
    {
        $admin = Admin::findOrFail($admin->id);
        return Inertia::render('Admin/Admins/Edit', [
            'admin' => $admin,
        ]);
    }

    public function update(AdminRequest $request, $id)
    {
        $data = array();

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $data = $request->only(['name', 'email']);
    

        if(!$this->service->update($id, $data)){
            return back()->with('error','Opps!, Erro ao atualizar o adminstrador.');
        }

        return redirect()->route('admin.admins.index')->with('success','Pronto!, Adminstrador atualizado com sucesso.');
    }

    public function show(Admin $admin)
    {
        $admin = Admin::findOrFail($admin->id);
        return Inertia::render('Admin/Admins/Edit', [
            'admin' => $admin,
        ]);
    }

    public function destroy(Admin $admin)
    {
        $admin = Admin::findOrFail($admin->id);
        $uploadFile = new UploadFile(); 
        if ($admin) {             
            $uploadFile->removeFile($admin->image);
        }
       
        if($admin->destroy($admin->id)){
            return redirect()->route('admin.admins.index')->with('success','Pronto!, Adminstrador deletado com sucesso.');
        }else{
            return redirect()->route('admin.admins.index')->with('error','Opps!, Erro ao deletar o adminstrador.');
        }
    }

    public function uploadFile(Request $request, UploadFile $uploadFile, $id)
    {
        $adminUpdate = Admin::FindOrFail($id);
      
        if($request->hasFile('image')){
            if ($adminUpdate->image != null) {             
                $uploadFile->removeFile($adminUpdate->image);
                $adminUpdate->image = '';
                $adminUpdate->save();
            }
        }        

        $path = $uploadFile->store($request->image, 'admins');

        if(!$this->service->update($id, ['image' => $path])){
            return back()->with('error','Opps!, Erro ao atualizar a foto adminstador.');
        }

        return redirect()->route('admin.admins.index')->with('success','Pronto!, Foto atualizada com sucesso.');
    }

    public function changeImage($id)
    {
        if(!$user = $this->service->findById($id)){
            return redirect()->back();
        }

        return Inertia::render('Admin/Admins/Change-Image', [
            'user' => $user,
        ]);
    }
    
}

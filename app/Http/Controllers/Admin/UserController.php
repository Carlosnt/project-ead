<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UploadFile;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $users = $this->service->getAll(
            filter: $request->filter ?? ""
        );
        dd($users);
        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = $this->service->create($data);

        if(!$user){
            return back()->with('error','Opps!, Erro ao Cadastrar o usuário.');
        }

        return redirect()->route('admin.users.index')->with('success','Pronto!, Departamento cadastrado com sucesso.');
    }

    public function edit(User $user)
    {
        $user = User::findOrFail($user->id);
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $data = array();

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $data = $request->only(['name', 'email']);


        if(!$this->service->update($id, $data)){
            return back()->with('error','Opps!, Erro ao atualizar o usuário.');
        }

        return redirect()->route('admin.users.index')->with('success','Pronto!, Usuário atualizado com sucesso.');
    }

    public function show(User $user)
    {
        $user = User::findOrFail($user->id);
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        $uploadFile = new UploadFile();
        if ($user) {
            $uploadFile->removeFile($user->image);
        }

        if($user->destroy($user->id)){
            return redirect()->route('admin.users.index')->with('success','Pronto!, Usuário deletado com sucesso.');
        }else{
            return redirect()->route('admin.users.index')->with('error','Opps!, Erro ao deletar o usuário.');
        }
    }

    public function uploadFile(Request $request, UploadFile $uploadFile, $id)
    {
        $userUpdate = User::FindOrFail($id);

        if($request->hasFile('image')){
            if ($userUpdate->image != null) {
                $uploadFile->removeFile($userUpdate->image);
                $userUpdate->image = '';
                $userUpdate->save();
            }
        }

        $path = $uploadFile->store($request->image, 'users');

        if(!$this->service->update($id, ['image' => $path])){
            return back()->with('error','Opps!, Erro ao atualizar a foto usuário.');
        }

        return redirect()->route('admin.users.index')->with('success','Pronto!, Foto atualizada com sucesso.');
    }

    public function changeImage($id)
    {
        if(!$user = $this->service->findById($id)){
            return redirect()->back();
        }

        return Inertia::render('Admin/Users/Change-Image', [
            'user' => $user,
        ]);
    }

}

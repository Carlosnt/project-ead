<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupportController extends Controller
{
    private $service;

    public function __construct(SupportService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $supports = $this->service->getSupports(
            status: $request->get('status', 'P')
        );

        return Inertia::render('Admin/Supports/Index', [
            'supports' => $supports,
        ]);
    }

    public function show($id)
    {
        if(!$support = $this->service->getSupport($id)){
            return back();
        }

        return Inertia::render('Admin/Supports/replaySupports',[
            'support' => $support
        ]);
    }


    public function destroy(Support $support)
    {
        $support = Support::findOrFail($support->id);

        if($support->destroy($support->id)){
            return redirect()->route('admin.supports.index')->with('success','Pronto!, Suporte deletado com sucesso.');
        }else{
            return redirect()->route('admin.supports.index')->with('error','Opps!, Erro ao deletar o suporte.');
        }
    }

}

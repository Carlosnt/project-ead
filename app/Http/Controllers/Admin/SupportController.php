<?php

namespace App\Http\Controllers\Admin;

use App\Enum\SupportEnum;
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
            status: $request->get('status') ? $request->get('status') : $request->get('status', 'P'),
            page: (int) $request->get('page', 1),
        );

        $statusOptions = converItemsOfArrayToObject(SupportEnum::cases());
        $array = new \stdClass();
        $array->data =  $supports->links();
        $ar = (object) $array->data->getData();
        $array->getData =  $ar;
        $array->getLinks = $array->getData->paginator;
        $array->setLinks = $array->getLinks;
        $data = (object) $array->setLinks;

        return Inertia::render('Admin/Supports/Index', [
            'supports' => $data,
            'statusOptions'=> $statusOptions
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

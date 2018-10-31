<?php

namespace App\Http\Controllers;

use App\Planilhas;
use Jobs\ProcessXLS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PlanilhasController extends Controller
{
    private $planilha;

    public function __construct(Planilhas $planilhas)
    {
        $this->planilha = $planilhas;
    }

    public function index()
    {

        $planilhas = $this->planilha->all();

        if ($planilhas) {
            return response()->json(compact('planilhas'),200);
        } else {
            return response()->json(['error' => 'Não existe planilha cadastrada.'],404);
        }
    }


    public function list(Request $request)
    {
        $planilhas = $this->planilha->find($request->id);

        if ($planilhas) {
            return response()->json(compact('planilhas'),200);
        } else {
            return response()->json(['error' => 'Não existe planilha cadastrada.'],404);
        }
    }

    public function move(Request $request)
    {
        if ($request->hasFile('arquivo')) {

            $destinationPath = storage_path('app\public\planilhas\\');
            $fileExtension = $request->arquivo->getClientOriginalExtension();
            $name = uniqid(date('HisYmd'));
            $fileName = $name.'.'.$fileExtension;

            if ($fileExtension != 'xlsx' && $fileExtension != 'xls') {
                return response()->json(['error' => 'Extensão Inválida'],415);
            }

            $upload = $request->arquivo->move($destinationPath, $fileName);

            if ($upload) {
                $this->planilha->name = $fileName;
                $this->planilha->status = 0; 
                $this->planilha->save();

                ProcessXLS::dispatch();

                return response()->json(['message' => 'sucess'],200);
            } else {
                return response()->json(['error' => 'Falha ao fazer upload.'],500);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Produtos;
use App\Planilhas;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class ProdutosController extends Controller
{

    private $produto;

    public function __construct(Produtos $produtos)
    {
        $this->produto = $produtos;
    }

    public function index()
    {

        $produto = $this->produto->all();

        if ($produto) {
            return response()->json(compact('produto'),200);
        } else {
            return response()->json(['error' => 'Não existe produto cadastrado.'],404);
        }
    }


    public function list(Request $request)
    {
        $produto = $this->produto->find($request->id);

        if ($produto) {
            return response()->json(compact('produto'),200);
        } else {
            return response()->json(['error' => 'Não existe produto cadastrado.'],404);
        }
    }

    public function edit(Request $request)
    {
        $produto = $this->produto->find($request->id);

        if ($produto) {

            $produto->name = $request->name;
            $produto->free_shipping = $request->Im;
            $produto->description = $request->Description;
            $produto->price = $request->Price;
            $produto->Category = $request->Category;

            $produto->save();

            return response()->json(compact('produto'),200);
        } else {
            return response()->json(['error' => 'Não foi possivel atualizar'],422);
        }

    }

    public function delete(Request $request)
    {
        $produto = $this->produto->find($request->id);

        if ($produto) {
            $produto->delete();

            return response()->json(['message' => 'sucess'],200);
        } else {
            return response()->json(['error' => 'Não existe produto cadastrado.'],404);
        }

    }

}

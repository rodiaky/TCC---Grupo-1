<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais;
use Illuminate\Support\Facades\DB;

class RepertoriosController extends Controller
{
    public function index($id)
    {
        $id_pasta = $id;
        $repertorios = Materiais::where('id_pasta', $id)->paginate(5); // Use paginate here
        return view('admin.repertorios.repertorios', compact('repertorios', 'id_pasta'));
    }

    public function visualizar($id, $id_pasta)
    {
        $repertorio = Materiais::where('id', $id)
            ->where('id_pasta', $id_pasta)
            ->first();

        if (!$repertorio) {
            return redirect()->route('admin.repertorios')->with('error', 'Repertório não encontrado.');
        }

        return view('admin.repertorios.visualizarRepertorio', compact('repertorio', 'id_pasta'));
    }

    public function adicionar() 
    {
        return view('admin.repertorios.adicionar');
    }

    public function editar($id) 
    {
        $materiais = Materiais::find($id);
        return view('admin.repertorios.editar', compact('materiais'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $id_pasta = $request->input('id_pasta');
        $filtros = $request->input('filtros');

        $query = Materiais::where('id_pasta', $id_pasta)
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'ILIKE', "%{$search}%");
            })
            ->when($filtros, function ($query) use ($filtros) {
                return $query->where('classificacao', $filtros);
            });

        $repertorios = $query->paginate(10); // Use paginate here

        return view('admin.repertorios.repertorios', compact('repertorios', 'id_pasta'));
    }

    public function filtrar(Request $request)
    {
        $filtros = $request->input('filtros');
        $id_pasta = $request->input('id_pasta');

        $query = Materiais::where('id_pasta', $id_pasta)
            ->when($filtros, function ($query) use ($filtros) {
                return $query->where('classificacao', $filtros);
            });

        $repertorios = $query->paginate(10); // Use paginate here

        return view('admin.repertorios.repertorios', compact('repertorios', 'id_pasta'));
    }

    public function excluir($id) 
    {
        Materiais::find($id)->delete();
        return redirect()->route('admin.repertorios');
    }

    public function salvar(Request $req)
    {
        $dados = $req->all();  
        Materiais::create($dados);
        return redirect()->route('admin.repertorios');
    }

    public function atualizar(Request $req, $id)
    {
        $dados = $req->all();
        Materiais::find($id)->update($dados);
        return redirect()->route('admin.repertorios');
    }
}


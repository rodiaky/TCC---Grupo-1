<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais;
use App\Models\Pastas;
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
        $temasRepertorios = Pastas::where('tipo', 'Repertório')->pluck('nome', 'id')->all();
        return view('admin.repertorios.adicionar',compact('temasRepertorios'));
    }

    public function editar($id) 
    {
        $repertorios = Materiais::join('pastas', 'materiais.id_pasta', '=', 'pastas.id')
        ->where('materiais.id', $id)
        ->select('materiais.*', 'pastas.nome as nome_pasta')
        ->first();
        $temasRepertorios = Pastas::where('tipo', 'Repertório')->pluck('nome', 'id')->all();
        return view('admin.repertorios.editar', compact('repertorios','temasRepertorios'));
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
        return redirect()->route('admin.temasRepertorios');
    }

    public function salvar(Request $req)
    {
        $dados = $req->all();  
        Materiais::create($dados);
        return redirect()->route('admin.temasRepertorios');
    }

    public function atualizar(Request $req, $id)
    {
        $dados = $req->all();
        Materiais::find($id)->update($dados);
        return redirect()->route('admin.temasRepertorios');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais;
use App\Models\Pastas;
use Illuminate\Support\Facades\DB;

class MateriaisController extends Controller
{
    public function index($id){
        $id_pasta = $id;
        $materiais = Materiais::join('pastas', 'materiais.id_pasta', '=', 'pastas.id')
        ->where('materiais.id_pasta', $id_pasta)
        ->select('materiais.*')
        ->get();
        $nome_pasta = Pastas::where('id', $id_pasta)
        ->select('pastas.nome')
        ->first();

        return view('admin.materiais.materiais', compact('materiais','id_pasta','nome_pasta'));
    }

    public function adicionar() {
        $pastas = Pastas::where('tipo', 'Material')->pluck('nome', 'id')->all();
        return view('admin.materiais.adicionar',compact('pastas'));
    }

    public function editar($id) {
        $materiais = Materiais::join('pastas', 'materiais.id_pasta', '=', 'pastas.id')
        ->where('materiais.id', $id)
        ->select('materiais.*', 'pastas.nome as nome_pasta')
        ->first();
        $pastas = Pastas::where('tipo', 'Material')->pluck('nome', 'id')->all();
        return view('admin.materiais.editar',compact('materiais','pastas'));
    }


    
    public function excluir($id) {
        Materiais::find($id)->delete();
        return redirect()->route('admin.pastasMateriais');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        Materiais::create($dados);
        return redirect()->route('admin.pastasMateriais');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Materiais::find($id)->update($dados);
        return redirect()->route('admin.pastasMateriais');
    }
}

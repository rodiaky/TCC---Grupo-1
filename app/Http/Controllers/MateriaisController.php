<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais;
use Illuminate\Support\Facades\DB;

class MateriaisController extends Controller
{
    public function index($id){
        $id_pasta = $id;
        $materiais = Materiais::join('pastas', 'materiais.id_pasta', '=', 'pastas.id')
        ->where('materiais.id', $id)
        ->select('materiais.*', 'pastas.nome as nome_pasta')
        ->get();
        return view('admin.materiais.materiais', compact('materiais','id_pasta'));
    }

    public function visualizar($id,$id_pasta)
    {
        // Recupera o item com o ID fornecido
        $material = Materiais::where('id', $id)
        ->where('id_pasta', $id_pasta)
        ->first();
        // Verifica se o item foi encontrado
        if (!$material) {
            // Redireciona ou exibe uma mensagem de erro se o item não for encontrado
            return redirect()->route('admin.materiais')->with('error', 'Repertório não encontrado.');
        }

        // Retorna a view com o item encontrado
        return view('admin.materiais.visualizarMaterial', compact('material','id_pasta'));
    }

    public function adicionar() {
        return view('admin.materiais.adicionar');
    }

    public function editar($id) {
        $materiais = Materiais::find($id);
        return view('admin.materiais.editar',compact('materiais'));
    }


    
    public function excluir($id) {
        Materiais::find($id)->delete();
        return redirect()->route('admin.materiais');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        Materiais::create($dados);
        return redirect()->route('admin.materiais');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Materiais::find($id)->update($dados);
        return redirect()->route('admin.materiais');
    }
}

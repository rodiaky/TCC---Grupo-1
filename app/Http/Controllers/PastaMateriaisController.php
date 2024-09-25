<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materiais;
use App\Models\Pastas;

class PastaMateriaisController extends Controller
{
    public function index() {
        $pastas = DB::table('pastas')
        ->select('pastas.*') 
        ->where('tipo', 'Material') 
        ->get();

        return view('admin.pastasMateriais.index', compact('pastas'));
    }

    public function adicionar() {
        return view('admin.pastasMateriais.adicionar');
    }

    public function editar($id) {
        $pastas = Pastas::findOrFail($id);
        return view('admin.pastasMateriais.editar', compact('pastas'));
    }

    public function excluir($id) {
        Pastas::find($id)->delete();
        return redirect()->route('admin.pastasMateriais');
    }

    public function salvar(Request $req) {
        $dados = $req->all();  
        Pastas::create($dados);
        return redirect()->route('admin.pastasMateriais');
    }

    public function atualizar(Request $req, $id) {
        $dados = $req->all();
        Pastas::find($id)->update($dados);
        return redirect()->route('admin.pastasMateriais');
    }

}

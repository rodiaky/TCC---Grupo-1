<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Materiais;
use App\Models\Pastas;

class TemaRepertoriosController extends Controller
{
    public function index() {
        $pastas = DB::table('pastas')
    ->select('pastas.*') 
    ->where('tipo', 'Repertório') 
    ->get();

        return view('admin.temasRepertorios.index', compact('pastas'));
    }

    public function adicionar() {
        return view('admin.temasRepertorios.adicionar');
    }

    public function editar($id) {
        $pastas = Pastas::findOrFail($id);
        return view('admin.temasRepertorios.editar', compact('pastas'));
    }

    public function excluir($id) {
        Pastas::find($id)->delete();
        return redirect()->route('admin.temasRepertorios');
    }

    public function salvar(Request $req) {
        $dados = $req->all();  
        Pastas::create($dados);
        return redirect()->route('admin.temasRepertorios');
    }

    public function atualizar(Request $req, $id) {
        $dados = $req->all();
        Pastas::find($id)->update($dados);
        return redirect()->route('admin.temasRepertorios');
    }

}

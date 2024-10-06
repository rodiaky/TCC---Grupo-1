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
        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/temasRepertorios'), $filename);
        $req->imagem =  $filename;

        $nome = $req->input('nome');
        
        $meuVetor = [
            'nome' => $nome,
            'imagem' => $filename,
            'tipo' => "Repertório"
            
        ];

        Pastas::create($meuVetor);
        return redirect()->route('admin.temasRepertorios');
    }

    public function atualizar(Request $req, $id) {
        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/temasRepertorios'), $filename);
        $req->imagem =  $filename;

        $nome = $req->input('nome');
        
        $meuVetor = [
            'nome' => $nome,
            'imagem' => $filename,
            'tipo' => "Repertório"
            
        ];
        Pastas::find($id)->update($meuVetor);
        return redirect()->route('admin.temasRepertorios');
    }

}

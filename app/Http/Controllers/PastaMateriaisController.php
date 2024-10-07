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
        ->orderby('nome','ASC') 
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

        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/pastasMateriais'), $filename);
        $req->imagem =  $filename;

        $nome = $req->input('nome');
        
        $meuVetor = [
            'nome' => $nome,
            'imagem' => $filename,
            'tipo' => "Material"
            
        ];

        Pastas::create($meuVetor);
        return redirect()->route('admin.pastasMateriais');
    }

    public function atualizar(Request $req, $id) {
        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/pastasMateriais'), $filename);
        $req->imagem =  $filename;

        $nome = $req->input('nome');
        
        $meuVetor = [
            'nome' => $nome,
            'imagem' => $filename,
            'tipo' => "Material"
            
        ];
    
        Pastas::find($id)->update($meuVetor);
        return redirect()->route('admin.pastasMateriais');
    }

}

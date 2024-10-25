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
        $file->move(('assets/temasRepertorios'), $filename);
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
        // Busca a pasta que será atualizada
        $pasta = Pastas::find($id);
    
        // Verifica se um novo arquivo foi enviado
        if ($req->hasFile('arquivo')) {
            $file = $req->file('arquivo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(('assets/temasRepertorios'), $filename);
        } else {
            // Mantém o arquivo existente caso nenhum novo arquivo tenha sido enviado
            $filename = $pasta->imagem;
        }
    
        $nome = $req->input('nome');
        
        // Atualiza o vetor com as informações
        $meuVetor = [
            'nome' => $nome,
            'imagem' => $filename,
            'tipo' => "Repertório"
        ];
    
        // Atualiza a pasta no banco de dados
        $pasta->update($meuVetor);
    
        return redirect()->route('admin.temasRepertorios');
    }
    

}

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

        $req->validate([
            'nome' => 'required|string|max:255',
            'arquivo' => 'required|file|mimes:png',
        ]);

        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(('assets/pastasMateriais'), $filename);
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
        $req->validate([
            'nome' => 'required|string|max:255',
            'arquivo' => 'required|file|mimes:png',
        ]);
        // Busca o registro atual no banco de dados para obter a imagem existente
        $pastaAtual = Pastas::find($id);
    
        // Verifica se um novo arquivo foi enviado
        if ($req->hasFile('arquivo')) {
            // Se um novo arquivo foi enviado, processa e armazena o novo arquivo
            $file = $req->file('arquivo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(('assets/pastasMateriais'), $filename);
        } else {
            // Se nenhum novo arquivo foi enviado, mantém a imagem existente
            $filename = $pastaAtual->imagem;
        }
    
        $nome = $req->input('nome');
        
        $meuVetor = [
            'nome' => $nome,
            'imagem' => $filename, // Mantém a imagem existente ou usa a nova
            'tipo' => "Material"
        ];
    
        // Atualiza o registro no banco de dados
        Pastas::find($id)->update($meuVetor);
    
        // Redireciona para a rota especificada
        return redirect()->route('admin.pastasMateriais');
    }
    

}

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
        ->orderby('materiais.nome','ASC')
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
        return back();
    }

    public function salvar(Request $req){


            $image = $req->file('filename');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('assets/materiais'), $imageName);
            $req->descricao =  $imageName;
            
            $nome = $req->input('nome');
            $idpasta = $req->input('id_pasta');

            $meuVetor = [
                'nome' => $nome,
                'descricao' => $imageName,
                'categoria' => "Material",
                'id_pasta'=> $idpasta
                
            ];
            
          
        Materiais::create($meuVetor);
        return redirect()->route('admin.pastasMateriais');

    }

    public function atualizar(Request $req, $id){
        $image = $req->file('arquivo');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('assets/materiais'), $imageName);
        $req->descricao =  $imageName;
            
        $nome = $req->input('nome');
        $idpasta = $req->input('id_pasta');

        $meuVetor = [
            'nome' => $nome,
            'descricao' => $imageName,
            'categoria' => "Material",
            'id_pasta'=> $idpasta
                
        ];
            
          
        Materiais::find($id)->update($meuVetor);
        return redirect()->route('admin.pastasMateriais');
    }
    public function show($imageName)
    {
        $diretorio = public_path('assets/materiais/');

        if (file_exists($diretorio.$imageName)) {
            // Retorna o arquivo PDF
            return response()->file($diretorio.$imageName, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; width= 50%; filename=' . $imageName,
                
            ]);
            /*return view('file', [
                'pdf_url' => asset($diretorio . $imageName)
            ]);*/
        } else {
            // Se o arquivo não existir, retorna uma resposta com status 404
            return response()->json(['error' => 'Arquivo nao encontrado.'], 404);
        }
   
        
    }
}

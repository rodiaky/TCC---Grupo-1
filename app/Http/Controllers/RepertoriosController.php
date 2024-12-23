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
        $repertorios = Materiais::where('id_pasta', $id)->paginate(10); // Use paginate here
        return view('admin.repertorios.repertorios', compact('repertorios', 'id_pasta'));
    }

    public function visualizar($id, $id_pasta)
    {
        $repertorio = Materiais::where('id', $id)
            ->where('id_pasta', $id_pasta)
            ->first();

       

        return view('admin.repertorios.visualizarRepertorio', compact('repertorio', 'id_pasta'));
    }

    public function adicionar() 
    {
        $url = url()->previous();
        $temasRepertorios = Pastas::where('tipo', 'Repertório')->pluck('nome', 'id')->all();
        return view('admin.repertorios.adicionar',compact('temasRepertorios','url'));
    }

    public function editar($id) 
    {
        $url = url()->previous();
        $repertorios = Materiais::join('pastas', 'materiais.id_pasta', '=', 'pastas.id')
        ->where('materiais.id', $id)
        ->select('materiais.*', 'pastas.nome as nome_pasta')
        ->first();
        $temasRepertorios = Pastas::where('tipo', 'Repertório')->pluck('nome', 'id')->all();
        return view('admin.repertorios.editar', compact('repertorios','temasRepertorios','url'));
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
        $validated = $req->validate([
            'nome' => 'required|string|max:255', 
            'classificacao' => 'required|string|max:255', 
            'descricao' => 'required|string|max:3000', 
            'imagem' => 'required|file|mimes:png', 
            'id_pasta' => 'required|integer|exists:pastas,id',
        ]);

        
        $image = $req->file('imagem');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(('assets/repertorios'), $imagename);
        $req->imagem =  $imagename;
        
        $nome = $req->input('nome');
        $idpasta = $req->input('id_pasta');
        $classificacao= $req->input('classificacao');
        $descricao = $req->input('descricao');


        $meuVetor = [
            'nome' => $nome,
            'categoria' => "Repertório",
            'classificacao' => $classificacao,
            'descricao' => $descricao,
            'imagem' => $imagename,
            'id_pasta' => $idpasta
        ];
         
        Materiais::create($meuVetor);
        return redirect()->route('admin.temasRepertorios');
    }

    public function atualizar(Request $req, $id)
    {
        $validated = $req->validate([
            'nome' => 'required|string|max:255', 
            'classificacao' => 'required|string|max:255', 
            'descricao' => 'required|string|max:3000', 
            'imagem' => 'required|file|mimes:png', 
            'id_pasta' => 'required|integer|exists:pastas,id',
        ]);

        if ($req->hasFile('imagem')) {
        $image = $req->file('imagem');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(('assets/repertorios'), $imagename);
        } else {
            $imagename = $req->input('imagem');
        }
        $nome = $req->input('nome');
        $idpasta = $req->input('id_pasta');
        $classificacao= $req->input('classificacao');
        $descricao = $req->input('descricao');


        $meuVetor = [
            'nome' => $nome,
            'categoria' => "Repertório",
            'classificacao' => $classificacao,
            'descricao' => $descricao,
            'imagem' => $imagename,
            'id_pasta' => $idpasta,
        ];

        Materiais::find($id)->update($meuVetor);
        $url = $req->input('url');
        return redirect()->route('admin.temasRepertorios');
        
    }
}
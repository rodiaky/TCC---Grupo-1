<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais;
use Illuminate\Support\Facades\DB;

class RepertoriosController extends Controller
{
    public function index(){
        $repertorios = Materiais::all();
        return view('site.repertorios', compact('repertorios'));
    }

    public function vizualizar($id)
    {
        // Recupera o item com o ID fornecido
        $repertorio = Materiais::find($id);

        // Verifica se o item foi encontrado
        if (!$repertorio) {
            // Redireciona ou exibe uma mensagem de erro se o item não for encontrado
            return redirect()->route('repertorios.index')->with('error', 'Repertório não encontrado.');
        }

        // Retorna a view com o item encontrado
        return view('site.vizualizarRepertorio', compact('repertorio'));
    }

    public function adicionar() {
        return view('admin.repertorios.adicionar');
    }

    public function editar($id) {
        $materiais = Materiais::find($id);
        return view('admin.repertorios.editar',compact('materiais'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $repertorios = DB::table('materiais')
            ->select('materiais.*')
            ->when($search, function ($query, $search) {
                return $query->where('materiais.nome', 'ILIKE', "%{$search}%");
            })
            ->get();
    
        return view('site.repertorios', compact('repertorios'));
    }


    public function excluir($id) {
        Materiais::find($id)->delete();
        return redirect()->route('admin.repertorios');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        $dados['id_semana'] = 4;
        Materiais::create($dados);
        return redirect()->route('admin.repertorios');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Materiais::find($id)->update($dados);
        return redirect()->route('admin.repertorios');
    }
}

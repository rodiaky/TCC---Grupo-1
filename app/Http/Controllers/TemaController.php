<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temas;
use Illuminate\Support\Facades\DB;
use App\Models\Bancas;


class TemaController extends Controller
{
    public function index(){
        $temas = DB::table('temas')
        ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
        ->select('temas.*', 'bancas.nome as banca_nome') // Select all fields from temas and banca name
        ->get();

    return view('admin.temas.index', compact('temas'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $temas = DB::table('temas')
            ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
            ->select('temas.*', 'bancas.nome as banca_nome')
            ->when($search, function ($query, $search) {
                return $query->where('temas.frase_tematica', 'ILIKE', "%{$search}%");
            })
            ->get();
    
        return view('admin.temas.index', compact('temas'));
    }


    public function adicionar() {
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.temas.adicionar', compact('bancas'));
    }

    public function editar($id) {
        $temas = Temas::findOrFail($id);
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.temas.editar',compact('temas','bancas'));
    }


    public function excluir($id) {
        Temas::find($id)->delete();
        return redirect()->route('admin.temas');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        Temas::create($dados);
        return redirect()->route('admin.temas');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Temas::find($id)->update($dados);
        return redirect()->route('admin.temas');
    }
}

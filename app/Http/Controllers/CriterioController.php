<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criterios;
use App\Models\Bancas;
use Illuminate\Support\Facades\DB;

class CriterioController extends Controller
{
    public function index(){
        $criterios = DB::table('criterios')
        ->join('bancas', 'criterios.id_banca', '=', 'bancas.id')
        ->select('criterios.*', 'bancas.nome as banca_nome') 
        ->get();
        return view('admin.criterios.index', compact('criterios'));
    }

    public function adicionar() {
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.criterios.adicionar', compact('bancas'));
    }

    public function editar($id) {
        $criterios = DB::table('criterios')
        ->join('bancas', 'criterios.id_banca', '=', 'bancas.id')
        ->select('criterios.*', 'bancas.nome as banca_nome') 
        ->where('criterios.id', '=', $id)
        ->first();
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.criterios.editar',compact('criterios','bancas'));
    }


    public function excluir($id) {
        Criterios::find($id)->delete();
        return redirect()->route('admin.criterios');
    }

    public function salvar(Request $req){

         $validated = $req->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'nota_maxima_criterio' => 'required|integer|min:0|max:200',
            'id_banca' => 'required|exists:bancas,id',
        ]);

        Criterios::create([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'],
            'nota_maxima_criterio' => $validated['nota_maxima_criterio'],
            'id_banca' => $validated['id_banca'],
        ]);
        return redirect()->route('admin.criterios');

    }

    public function atualizar(Request $req, $id){
        $validated = $req->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'nota_maxima_criterio' => 'required|integer|min:0|max:200',
            'id_banca' => 'required|exists:bancas,id',
        ]);
        $criterio = Criterios::findOrFail($id);
        $criterio->update([
            'nome' => $validated['nome'],
            'descricao' => $validated['descricao'],
            'nota_maxima_criterio' => $validated['nota_maxima_criterio'],
            'id_banca' => $validated['id_banca'],
        ]);
        return redirect()->route('admin.criterios');
    }
}

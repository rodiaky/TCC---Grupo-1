<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bancas;

class BancaController extends Controller
{
    public function index(){
        $bancas = Bancas::all();
        return view('admin.bancas.index', compact('bancas'));
    }

    public function adicionar() {
        return view('admin.bancas.adicionar');
    }

    public function editar($id) {
        $bancas = Bancas::find($id);
        return view('admin.bancas.editar',compact('bancas'));
    }


    public function excluir($id) {
        Bancas::find($id)->delete();
        return redirect()->route('admin.bancas');
    }

    public function salvar(Request $req){
        $req->validate([
            'nome' => 'required|string|max:255',
            'nota_maxima_banca' => 'required|numeric|min:0|max:1000',
        ]);
    

        Bancas::create([
            'nome' => $req->nome,
            'nota_maxima_banca' => $req->nota_maxima_banca,
        ]);
        return redirect()->route('admin.bancas');

    }

    public function atualizar(Request $req, $id){
 
    $req->validate([
        'nome' => 'required|string|max:255',
        'nota_maxima_banca' => 'required|numeric|min:0|max:1000',
    ]);


    $banca = Bancas::findOrFail($id);
    $banca->update([
        'nome' => $req->nome,
        'nota_maxima_banca' => $req->nota_maxima_banca,
    ]);
        return redirect()->route('admin.bancas');
    }
}

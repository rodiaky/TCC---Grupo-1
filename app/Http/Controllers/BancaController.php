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
        $dados = $req->all();  
        Bancas::create($dados);
        return redirect()->route('admin.bancas');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Bancas::find($id)->update($dados);
        return redirect()->route('admin.bancas');
    }
}

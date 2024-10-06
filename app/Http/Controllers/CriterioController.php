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
        $dados = $req->all();  
        Criterios::create($dados);
        return redirect()->route('admin.criterios');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Criterios::find($id)->update($dados);
        return redirect()->to(url()->previous());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perguntas;
use App\Models\Bancas;

class QuestoesController extends Controller
{
    public function index(){
        return view('admin.questoes.index');
    }

    public function gramatica(){
        $titulo = "Gramática";
        $questoes = Perguntas::join('bancas', 'perguntas.id_banca', '=', 'bancas.id')
        ->where('perguntas.disciplina', 'Gramática')
        ->select('perguntas.*', 'bancas.nome as banca_nome')
        ->orderBy('perguntas.ano', 'desc') 
        ->paginate(10);
        return view('admin.questoes.questoes', compact('questoes','titulo'));
    }

    public function literatura(){
        $titulo = "Literatura";
        $questoes = Perguntas::join('bancas', 'perguntas.id_banca', '=', 'bancas.id')
        ->where('perguntas.disciplina', 'Literatura')
        ->select('perguntas.*', 'bancas.nome as banca_nome')
        ->orderBy('perguntas.ano', 'desc') 
        ->paginate(10);
        return view('admin.questoes.questoes', compact('questoes','titulo'));
    }

    public function interpretacao(){
        $titulo = "Interpretação de Texto";
        $questoes = Perguntas::join('bancas', 'perguntas.id_banca', '=', 'bancas.id')
        ->where('perguntas.disciplina', 'Interpretação de Texto')
        ->select('perguntas.*', 'bancas.nome as banca_nome')
        ->orderBy('perguntas.ano', 'desc') 
        ->paginate(10);
        return view('admin.questoes.questoes', compact('questoes','titulo'));
    }

    public function adicionar() {
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.questoes.adicionar',compact('bancas'));
    }

    public function editar($id) {
        $questoes = Perguntas::join('bancas', 'perguntas.id_banca', '=', 'bancas.id')
        ->where('perguntas.id', $id)
        ->select('perguntas.*', 'bancas.nome as banca_nome')
        ->first();
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.questoes.editar',compact('questoes','bancas'));
    }


    public function excluir($id) {
        Perguntas::find($id)->delete();
        return redirect()->route('admin.questoes');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        Perguntas::create($dados);
        return redirect()->route('admin.questoes');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Perguntas::find($id)->update($dados);
        return redirect()->route('admin.questoes');
    }
}

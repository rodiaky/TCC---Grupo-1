<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perguntas;

class QuestoesController extends Controller
{
    public function index(){
        return view('admin.questoes.index');
    }

    public function gramatica(){
        $titulo = "Gramática";
        $questoes = Perguntas::where('disciplina', 'Gramática')->get();
        return view('admin.questoes.questoes', compact('questoes','titulo'));
    }

    public function literatura(){
        $titulo = "Literatura";
        $questoes = Perguntas::where('disciplina', 'Literatura')->get();
        return view('admin.questoes.questoes', compact('questoes','titulo'));
    }

    public function interpretacao(){
        $titulo = "Interpretação de texto";
        $questoes = Perguntas::where('disciplina', 'Interpretação de Texto')->get();
        return view('admin.questoes.questoes', compact('questoes','titulo'));
    }

    public function adicionar() {
        return view('admin.questoes.adicionar');
    }

    public function editar($id) {
        $questoes = Perguntas::find($id);
        return view('admin.questoes.editar',compact('questoes'));
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

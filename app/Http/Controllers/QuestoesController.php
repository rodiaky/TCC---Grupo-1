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

    public function salvar(Request $req) {
        $req->validate([
            'enunciado' => 'required|string|max:255',
            'alternativa_A' => 'required|string|max:255',
            'alternativa_B' => 'required|string|max:255',
            'alternativa_C' => 'required|string|max:255',
            'alternativa_D' => 'required|string|max:255',
            'alternativa_E' => 'nullable|string|max:255',
            'ano' => 'required|integer|min:2000',
            'assunto' => 'required|string|max:100',
            'resposta' => 'required|string|in:A,B,C,D,E',
            'disciplina' => 'required|string|max:100',
            'id_banca' => 'required|exists:bancas,id',
        ]);
    
        $dados = $req->all();  
        Perguntas::create($dados);
        return redirect()->route('admin.questoes')->with('success', 'Questão adicionada com sucesso!');
    }
    
    public function atualizar(Request $req, $id) {
        $req->validate([
            'enunciado' => 'required|string|max:255',
            'alternativa_A' => 'required|string|max:255',
            'alternativa_B' => 'required|string|max:255',
            'alternativa_C' => 'required|string|max:255',
            'alternativa_D' => 'required|string|max:255',
            'alternativa_E' => 'nullable|string|max:255',
            'ano' => 'required|integer|min:2000',
            'assunto' => 'required|string|max:100',
            'resposta' => 'required|string|in:A,B,C,D,E',
            'disciplina' => 'required|string|max:100',
            'id_banca' => 'required|exists:bancas,id',
        ]);
    
        $dados = $req->all();
        Perguntas::find($id)->update($dados);
        return redirect()->route('admin.questoes')->with('success', 'Questão atualizada com sucesso!');
    }
    
}

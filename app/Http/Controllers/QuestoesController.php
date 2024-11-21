<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perguntas;
use App\Models\Bancas;
use App\Models\Questoes;

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
        $bancas = Bancas::pluck('nome', 'id')->sort()->all();
        $assuntos = Perguntas::where('disciplina', $titulo)->select('assunto')->distinct()->pluck('assunto')->sort()->all();
        $anos = Perguntas::select('ano')->distinct()->pluck('ano')->sortDesc()->all();
        return view('admin.questoes.questoes', compact('questoes','titulo','bancas','assuntos','anos'));
    }

    public function literatura(){
        $titulo = "Literatura";
        $questoes = Perguntas::join('bancas', 'perguntas.id_banca', '=', 'bancas.id')
        ->where('perguntas.disciplina', 'Literatura')
        ->select('perguntas.*', 'bancas.nome as banca_nome')
        ->orderBy('perguntas.ano', 'desc') 
        ->paginate(10);
        $bancas = Bancas::pluck('nome', 'id')->sort()->all();
        $assuntos = Perguntas::where('disciplina', $titulo)->select('assunto')->distinct()->pluck('assunto')->sort()->all();
        $anos = Perguntas::select('ano')->distinct()->pluck('ano')->sortDesc()->all();
        return view('admin.questoes.questoes', compact('questoes','titulo','bancas','assuntos','anos'));
    }

    public function interpretacao(){
        $titulo = "Interpretação de Texto";
        $questoes = Perguntas::join('bancas', 'perguntas.id_banca', '=', 'bancas.id')
        ->where('perguntas.disciplina', 'Interpretação de Texto')
        ->select('perguntas.*', 'bancas.nome as banca_nome')
        ->orderBy('perguntas.ano', 'desc') 
        ->paginate(10);
        $bancas = Bancas::pluck('nome', 'id')->sort()->all();
        $assuntos = Perguntas::where('disciplina', $titulo)->select('assunto')->distinct()->pluck('assunto')->sort()->all();
        $anos = Perguntas::select('ano')->distinct()->pluck('ano')->sortDesc()->all();
        return view('admin.questoes.questoes', compact('questoes','titulo','bancas','assuntos','anos'));
    }

    public function filtrar(Request $request)
    {
        $query = Perguntas::select('perguntas.*', 'bancas.nome as banca_nome')
            ->join('bancas', 'perguntas.id_banca', '=', 'bancas.id') 
            ->orderBy('perguntas.ano', 'desc');

        if ($request->filled('disciplina')) {
            $query->where('disciplina', $request->disciplina);
        }

        if ($request->filled('id_banca')) {
            $query->where('id_banca', $request->id_banca);
        }


        if ($request->filled('assunto')) {
            $query->where('assunto', $request->assunto);
        }


        if ($request->filled('ano')) {
            $query->where('ano', $request->ano);
        }


        $questoes = $query->paginate(10);
        $titulo = $request->disciplina;
        $bancas = Bancas::pluck('nome', 'id')->sort()->all();
        $assuntos = Perguntas::where('disciplina', $titulo)->select('assunto')->distinct()->pluck('assunto')->sort()->all();
        $anos = Perguntas::select('ano')->distinct()->pluck('ano')->sortDesc()->all();

        return view('admin.questoes.questoes', compact('questoes','titulo','bancas','assuntos','anos'));
    }


    public function adicionar() {
        $url = url()->previous();
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.questoes.adicionar',compact('bancas','url'));
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
            'enunciado' => 'required|string|max:3000',
            'alternativa_A' => 'required|string|max:1000',
            'alternativa_B' => 'required|string|max:1000',
            'alternativa_C' => 'required|string|max:1000',
            'alternativa_D' => 'required|string|max:1000',
            'alternativa_E' => 'nullable|string|max:1000',
            'ano' => 'required|integer|min:2000',
            'assunto' => 'required|string|max:100',
            'resposta' => 'required|string|in:A,B,C,D,E',
            'disciplina' => 'required|string|max:100',
            'id_banca' => 'required|exists:bancas,id',
        ]);
    
        $dados = $req->all();  
        Perguntas::create($dados);
        return redirect()->route('admin.questoes');
    }
    
    public function atualizar(Request $req, $id) {
        $req->validate([
            'enunciado' => 'required|string|max:3000',
            'alternativa_A' => 'required|string|max:1000',
            'alternativa_B' => 'required|string|max:1000',
            'alternativa_C' => 'required|string|max:1000',
            'alternativa_D' => 'required|string|max:1000',
            'alternativa_E' => 'nullable|string|max:1000',
            'ano' => 'required|integer|min:2000',
            'assunto' => 'required|string|max:100',
            'resposta' => 'required|string|in:A,B,C,D,E',
            'disciplina' => 'required|string|max:100',
            'id_banca' => 'required|exists:bancas,id',
        ]);
    
        $dados = $req->all();
        Perguntas::find($id)->update($dados);
        return redirect()->route('admin.questoes');
    }
    
}

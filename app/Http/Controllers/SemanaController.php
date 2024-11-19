<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semanas;
use App\Models\Turmas;
use Carbon\Carbon;

class SemanaController extends Controller
{
    public function index(){
        $semanas = Semanas::all();
        return view('admin.semanas.index', compact('semanas'));
    }

    public function adicionar() {
        return view('admin.semanas.adicionar');
    }

    public function editar($id) {
        $semanas = Semanas::find($id);
        $semanas->data_inicio = Carbon::createFromFormat('Y-m-d', $semanas->data_inicio)->format('d/m/Y');
        $semanas->data_fim = Carbon::createFromFormat('Y-m-d', $semanas->data_fim)->format('d/m/Y');
        return view('admin.semanas.editar',compact('semanas'));
    }


    public function excluir($id) {
        Semanas::find($id)->delete();
        return redirect()->route('admin.semanas');
    }

    public function salvar(Request $req){
        $req->validate([
            'nome' => 'required|string|max:255',
            'data_inicio' => 'required|date_format:d/m/Y',
            'data_fim' => 'required|date_format:d/m/Y|after_or_equal:data_inicio',
            'descricao' => 'required|string|max:500',
        ]);
    
        $dados = $req->all();  
        $dados['data_inicio'] = Carbon::createFromFormat('d/m/Y', $dados['data_inicio'])->format('Y-m-d');
        $dados['data_fim'] = Carbon::createFromFormat('d/m/Y', $dados['data_fim'])->format('Y-m-d');
        Semanas::create($dados);
        return redirect()->route('admin.semanas');

    }

    public function atualizar(Request $req, $id){
        $req->validate([
            'nome' => 'required|string|max:255',
            'data_inicio' => 'required|date_format:d/m/Y',
            'data_fim' => 'required|date_format:d/m/Y|after_or_equal:data_inicio',
            'descricao' => 'required|string|max:500',
        ]);
    
        $dados = $req->all();
        $dados['data_inicio'] = Carbon::createFromFormat('d/m/Y', $dados['data_inicio'])->format('Y-m-d');
        $dados['data_fim'] = Carbon::createFromFormat('d/m/Y', $dados['data_fim'])->format('Y-m-d');
        Semanas::find($id)->update($dados);
        return redirect()->route('admin.semanas');
    }
}

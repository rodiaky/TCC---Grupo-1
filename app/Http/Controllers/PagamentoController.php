<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\pagamentos;

class PagamentoController extends Controller
{

    public function adicionar() {
        $alunos = DB::table('users')
        ->join('alunos', 'users.id', '=', 'alunos.id_user')
        ->select('users.name','alunos.id')
        ->where('eh_admin','Aluno')
        ->get();
        return view('admin.pagamentos.adicionar',compact('alunos'));
    }

    public function editar($id) {
        $pagamentos = Pagamentos::find($id);
        return view('admin.pagamentos.editar',compact('pagamentos'));
    }


    public function excluir($id) {
        $id_aluno = Pagamentos::select('id_aluno')->find($id)->first();
        Pagamentos::find($id)->delete();
        return redirect()->route('admin.turmas.aluno', ['id' => $id_aluno]);
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        Pagamentos::create($dados);
        return redirect()->route('admin.turmas.aluno');

    }

    public function atualizar(Request $req, $id){
        $id_aluno = Pagamentos::select('id_aluno')->find($id);
        $dados = $req->all();
        Pagamentos::find($id)->update($dados);
        return redirect()->route('admin.turmas.aluno', $id_aluno);
    }
}

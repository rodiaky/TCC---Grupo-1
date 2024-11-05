<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pagamentos;
use App\Models\Alunos;

class PagamentoController extends Controller
{

    public function adicionar($id) {
        $alunos = DB::table('users')
        ->join('alunos', 'users.id', '=', 'alunos.id_user')
        ->select('users.name','alunos.id')
        ->where('eh_admin','Aluno')
        ->get();
        return view('admin.pagamentos.adicionar',compact('alunos','id'));
    }

    public function editar($id) {
        $pagamentos = Pagamentos::find($id);
        return view('admin.pagamentos.editar',compact('pagamentos'));
    }


    public function excluir($id) {
        $id_aluno = Pagamentos::find($id)->id_aluno;
        $idUser = Alunos::where('id', $id_aluno)
            ->pluck('id_user')
            ->first();
        Pagamentos::find($id)->delete();
        return redirect()->route('admin.turmas.aluno', ['id' =>  $idUser]);
    }

    public function salvar(Request $req, $id){
        $idAluno = Alunos::where('id_user', $id)
            ->pluck('id')
            ->first();
        $dados = $req->all();
        $dados->id_aluno = $idAluno;  
        Pagamentos::create($dados);
        return redirect()->route('admin.turmas.aluno',['id' =>  $id]);

    }

    public function atualizar(Request $req, $id){
        $id_aluno = Pagamentos::find($id)->id_aluno;
        $idUser = Alunos::where('id', $id_aluno)
            ->pluck('id_user')
            ->first();
        $dados = $req->all();
        Pagamentos::find($id)->update($dados);
        return redirect()->route('admin.turmas.aluno',['id' =>  $idUser]);
    }
}

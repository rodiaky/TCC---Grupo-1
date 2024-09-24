<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turmas;
use App\Models\Funcionarios;
use App\Models\Pessoas;
use Illuminate\Support\Facades\DB;

class TurmasController extends Controller
{
    public function index(){
        $rows = Turmas::all();
        return view('admin.turmas.turmas', compact('rows'));
    }

    public function adicionar() {
        $professores = DB::table('users')
        ->join('funcionarios', 'users.id', '=', 'funcionarios.id_user')
        ->select('users.name', 'funcionarios.id')
        ->where('users.eh_admin', "Professor")
        ->get();
        return view('site.turmas.adicionar',compact('professores'));
    }

    public function editar($id) {
        $linha = Turmas::find($id);
        $professores = DB::table('users')
        ->join('funcionarios', 'users.id', '=', 'funcionarios.id_user')
        ->select('users.name', 'funcionarios.id')
        ->where('users.eh_admin', "Professor")
        ->get();
        return view('site.turmas.editar',compact('linha','professores'));
    }


    public function excluir($id) {
        Turmas::find($id)->delete();
        return redirect()->route('site.turmas');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        Turmas::create($dados);
        return redirect()->route('site.turmas');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();


        $id_funcionario = DB::table('users')
            ->join('funcionarios', 'users.id', '=', 'funcionarios.id_user')
            ->where('users.id', '=', $id) 
            ->value('funcionarios.id');
    

        $dados['id_funcionario'] = $id_funcionario;
    
        
        Turmas::find($id)->update($dados);
    
        return redirect()->route('site.turmas');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function indexAluno() {
        
        $idUser = $_SESSION['id'];

        $perfil = DB::table('users')
            ->join('alunos', 'users.id', '=', 'alunos.id_user')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->select('users.name as name', 'turmas.nome as nome_turma', 'users.email as email', 'users.password as password')
            ->where('users.id', '=', $idUser)
            ->first();

        return view('site.perfil', compact('perfil'));
    } 

    public function indexProfessor() {
        
        $idUser = $_SESSION['id'];

        $perfil = DB::table('users')
            ->join('funcionarios', 'users.id', '=', 'funcionarios.id_user')
            ->select('users.name as name', 'users.email as email', 'users.password as password')
            ->where('users.id', '=', $idUser)
            ->first();

        return view('site.perfil', compact('perfil'));
    } 
}

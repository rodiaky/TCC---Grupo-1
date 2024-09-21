<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function index() {
        
        $idUser = Auth::id();

        $perfil = DB::table('users')
            ->join('alunos', 'users.id', '=', 'alunos.id_user')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->select('users.name as name', 'turmas.nome as nome_turma')
            ->where('users.id', '=', $idUser)
            ->first();

        return view('site.perfil', compact('perfil'));
    } 
}

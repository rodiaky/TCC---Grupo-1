<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turmas;
use App\Models\Funcionarios;
use App\Models\Pessoas;
use Illuminate\Support\Facades\DB;

class TurmasController extends Controller
{
    public function index() {
        // Obter dias_aula únicos
        $diasAula = DB::table('turmas')
            ->select('dias_aula')
            ->distinct()
            ->get();
    
        // Mapear dias da semana
        $diasSemana = [
            'Domingo' => 0,
            'Segunda' => 1,
            'Terça' => 2,
            'Quarta' => 3,
            'Quinta' => 4,
            'Sexta' => 5,
            'Sábado' => 6,
        ];
    
        // Ordenar dias
        $diasAula = $diasAula->sortBy(function ($dia) use ($diasSemana) {
            return $diasSemana[$dia->dias_aula] ?? 7;
        })->values();
    
        // Inicializar array
        $turmasPorDia = [];
    
        foreach ($diasAula as $dia) {
            // Obter turmas que correspondem ao dia atual
            $turmas = DB::table('turmas')
                ->select('id', 'nome') // Certifique-se de incluir o ID
                ->where('dias_aula', $dia->dias_aula)
                ->get();
    
            // Armazenar turmas em um array
            $turmasPorDia[$dia->dias_aula] = $turmas;
        }
    
        return view('admin.turmas.turmas', compact('turmasPorDia', 'diasAula'));
    }
    
    
    
    
    

    public function adicionar() {
        $professores = DB::table('users')
        ->join('funcionarios', 'users.id', '=', 'funcionarios.id_user')
        ->select('users.name', 'funcionarios.id')
        ->where('users.eh_admin', "Professor")
        ->get();
        return view('admin.turmas.adicionar',compact('professores'));
    }

    public function editar($id) {
        $linha = Turmas::find($id);
        $professores = DB::table('users')
        ->join('funcionarios', 'users.id', '=', 'funcionarios.id_user')
        ->select('users.name', 'funcionarios.id')
        ->where('users.eh_admin', "Professor")
        ->get();
        return view('admin.turmas.editar',compact('linha','professores'));
    }


    public function excluir($id) {
        Turmas::find($id)->delete();
        return redirect()->route('admin.turmas.turmas');
    }

    public function salvar(Request $req){
        // Validação dos dados
        $validatedData = $req->validate([
            'nome-turma' => 'required|string|max:255',
            'dias_aula' => 'required|string',
            'horario' => 'required|string',
        ], [
            'nome-turma.required' => 'O nome da turma é obrigatório.',
            'dias_aula.required' => 'O dia da aula é obrigatório.',
            'horario.required' => 'O horário é obrigatório.',
        ]);
    
        Turmas::create($validatedData);
    
        return redirect()->route('admin.turmas.turmas')->with('success', 'Turma adicionada com sucesso!');
    }
    
    public function atualizar(Request $req, $id){
        // Validação dos dados
        $validatedData = $req->validate([
            'nome-turma' => 'required|string|max:255',
            'dias_aula' => 'required|string',
            'horario' => 'required|string',
        ], [
            'nome-turma.required' => 'O nome da turma é obrigatório.',
            'dias_aula.required' => 'O dia da aula é obrigatório.',
            'horario.required' => 'O horário é obrigatório.',
        ]);
    
        $turma = Turmas::find($id);
        if (!$turma) {
            return redirect()->route('admin.turmas.turmas')->withErrors(['error' => 'Turma não encontrada.']);
        }
    
        $turma->update($validatedData);
    
        return redirect()->route('admin.turmas.turmas')->with('success', 'Turma atualizada com sucesso!');
    }    
}
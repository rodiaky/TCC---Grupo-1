<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turmas;
use App\Models\Funcionarios;
use App\Models\User;
use App\Models\Pessoas;
use App\Models\Alunos;
use App\Models\Pagamentos;
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
        return view('admin.turmas.adicionar');
    }

    public function editar($id) {
        $turmas = Turmas::find($id);
 
        return view('admin.turmas.editar',compact('turmas'));
    }


    public function excluir($id) {
        Turmas::find($id)->delete();
        return redirect()->route('admin.turmas');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        Turmas::create($dados);
        return redirect()->route('admin.turmas');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
    
        
        Turmas::find($id)->update($dados);
    
        return redirect()->route('admin.turmas');
    }
 
}
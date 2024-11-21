<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtribuirController extends Controller
{
     public function adicionarTema()
     {
        $semanas = \DB::table('semanas')->select('id', 'nome')->orderBy('nome', 'asc')->get();
        $temas = \DB::table('temas')->select('id', 'nome')->orderBy('nome', 'asc')->get();
        return view('admin.atribuir.tema', compact('semanas','temas')); 
     }
 
     // Salvar Tema
     public function salvarTema(Request $request)
     {
         // Validação dos dados
         $validatedData = $request->validate([
             'id_semana' => 'required|integer',
             'id_tema' => 'required|integer',
         ]);
 
         // Lógica para salvar o tema no banco
         // Exemplo:
         // Tema::create($validatedData);
 
         return redirect()->route('professor.home');
     }
 
     public function excluirTema($id_semana, $id_tema)
     {
        \DB::table('semanas_temas')->where([
            ['id_semana', '=', $id_semana],
            ['id_tema', '=', $id_tema],
        ])->delete();
 
         return redirect()->route('professor.home');
     }
 
     public function adicionarMaterial()
     {
        $semanas = \DB::table('semanas')->select('id', 'nome')->orderBy('nome', 'asc')->get();
        $materiais = \DB::table('materiais')->select('id', 'nome')->where('categoria', 'Material')->orderBy('nome', 'asc')->get();
        return view('admin.atribuir.material', compact('semanas','materiais')); 
     }
 
     // Salvar Material
     public function salvarMaterial(Request $request)
     {
         // Validação dos dados
         $validatedData = $request->validate([
             'id_semana' => 'required|integer',
             'id_material' => 'required|integer',
         ]);
 
         // Lógica para salvar o material no banco
         // Exemplo:
         // Material::create($validatedData);
 
         return redirect()->route('professor.home');
     }
 

     public function excluirMaterial($id_semana, $id_material)
     {
        \DB::table('semanas_materiais')->where([
            ['id_semana', '=', $id_semana],
            ['id_material', '=', $id_material],
        ])->delete();
 
         return redirect()->route('professor.home');
     }
 

     public function adicionarRepertorio()
     {
        $semanas = \DB::table('semanas')->select('id', 'nome')->orderBy('nome', 'asc')->get();
        $materiais = \DB::table('materiais')->select('id', 'nome')->where('categoria', 'Repertório')->orderBy('nome', 'asc')->get();
        return view('admin.atribuir.repertorio', compact('semanas','materiais')); // Substitua pelo nome correto da view
     }
 
     // Salvar Repertório
     public function salvarRepertorio(Request $request)
     {
         // Validação dos dados
         $validatedData = $request->validate([
             'id_semana' => 'required|integer',
             'id_material' => 'required|integer',
         ]);
 
         return redirect()->route('professor.home');
     }
}

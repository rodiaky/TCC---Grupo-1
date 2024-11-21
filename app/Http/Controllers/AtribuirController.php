<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SemanasMateriais;
use App\Models\SemanasTemas;

class AtribuirController extends Controller
{
     public function adicionarTema()
     {
        $semanas = \DB::table('semanas')->select('id', 'nome')->orderBy('nome', 'asc')->get();
        $temas = \DB::table('temas')->select('id', 'frase_tematica')->orderBy('frase_tematica', 'asc')->get();
        return view('admin.atribuir.tema', compact('semanas','temas')); 
     }
 

     public function salvarTema(Request $request)
     {
         // Validação dos dados - 'id_tema' será um array de IDs
         $validatedData = $request->validate([
             'id_semana' => 'required|integer|exists:semanas,id', // Verifica se a semana existe
             'id_tema' => 'required|array', // Verifica se 'id_tema' é um array
             'id_tema.*' => 'integer|exists:temas,id', // Valida cada ID de tema individualmente
         ]);
     
         // Inicializa um array para erros
         $erros = [];
     
         // Verifica duplicidade antes de inserir
         foreach ($request->id_tema as $id_tema) {
             $exists = SemanasTemas::where('id_semana', $request->id_semana)
                 ->where('id_tema', $id_tema)
                 ->exists();
     
             if ($exists) {
                 $erros[] = "Um dos temas já está associado à semana";
             } else {
                 // Insere apenas se não for duplicado
                 SemanasTemas::create([
                     'id_semana' => $request->id_semana,
                     'id_tema' => $id_tema,
                 ]);
             }
         }
     
         // Se houver erros, retorna à página anterior com mensagens de erro
         if (!empty($erros)) {
             return redirect()->back()
                 ->withErrors($erros)
                 ->withInput(); // Retorna os dados do formulário para que o usuário possa corrigi-los
         }
     
         // Redireciona para a página de sucesso
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
         // Validação dos dados - 'id_tema' será um array de IDs
         $validatedData = $request->validate([
            'id_semana' => 'required|integer|exists:semanas,id', // Verifica se a semana existe
            'id_material' => 'required|array', // Verifica se 'id_tema' é um array
            'id_material.*' => 'integer|exists:materiais,id', // Valida cada ID de tema individualmente
        ]);
    
        // Inicializa um array para erros
        $erros = [];
    
        // Verifica duplicidade antes de inserir
        foreach ($request->id_material as $id_material) {
            $exists = SemanasMateriais::where('id_semana', $request->id_semana)
                ->where('id_material', $id_material)
                ->exists();
    
            if ($exists) {
                $erros[] = "Um dos materiais já está associado à semana";
            } else {
                // Insere apenas se não for duplicado
                SemanasTemas::create([
                    'id_semana' => $request->id_semana,
                    'id_material' => $id_material,
                ]);
            }
        }
    
        // Se houver erros, retorna à página anterior com mensagens de erro
        if (!empty($erros)) {
            return redirect()->back()
                ->withErrors($erros)
                ->withInput(); // Retorna os dados do formulário para que o usuário possa corrigi-los
        }
    
        // Redireciona para a página de sucesso
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
        // Validação dos dados - 'id_tema' será um array de IDs
        $validatedData = $request->validate([
            'id_semana' => 'required|integer|exists:semanas,id', // Verifica se a semana existe
            'id_material' => 'required|array', // Verifica se 'id_tema' é um array
            'id_material.*' => 'integer|exists:materiais,id', // Valida cada ID de tema individualmente
        ]);
    
        // Inicializa um array para erros
        $erros = [];
    
        // Verifica duplicidade antes de inserir
        foreach ($request->id_material as $id_material) {
            $exists = SemanasMateriais::where('id_semana', $request->id_semana)
                ->where('id_material', $id_material)
                ->exists();
    
            if ($exists) {
                $erros[] = "Um dos materiais já está associado à semana";
            } else {
                // Insere apenas se não for duplicado
                SemanasTemas::create([
                    'id_semana' => $request->id_semana,
                    'id_material' => $id_material,
                ]);
            }
        }
    
        // Se houver erros, retorna à página anterior com mensagens de erro
        if (!empty($erros)) {
            return redirect()->back()
                ->withErrors($erros)
                ->withInput(); // Retorna os dados do formulário para que o usuário possa corrigi-los
        }
    
        // Redireciona para a página de sucesso
        return redirect()->route('professor.home');
     }
}

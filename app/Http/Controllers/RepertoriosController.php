<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiais;

class RepertoriosController extends Controller
{
    public function index(){
        $repertorios = Materiais::all();
        return view('site.repertorios', compact('repertorios'));
    }

    public function adicionar() {
        return view('admin.repertorios.adicionar');
    }

    public function editar($id) {
        $materiais = Materiais::find($id);
        return view('admin.repertorios.editar',compact('materiais'));
    }


    public function excluir($id) {
        Materiais::find($id)->delete();
        return redirect()->route('admin.repertorios');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        $dados['id_semana'] = 4;
        Materiais::create($dados);
        return redirect()->route('admin.repertorios');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Materiais::find($id)->update($dados);
        return redirect()->route('admin.repertorios');
    }
}

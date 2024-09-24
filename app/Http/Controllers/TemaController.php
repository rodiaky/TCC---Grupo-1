<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temas;
use Illuminate\Support\Facades\DB;
use App\Models\Bancas;
use App\Models\Redacoes;

class TemaController extends Controller
{
    public function index() {
        $temas = DB::table('temas')
            ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
            ->select('temas.*', 'bancas.nome as banca_nome')
            ->paginate(10);

        return view('admin.temas.index', compact('temas'));
    }

    public function visualizarTema($id) {
        $tema = DB::table('temas')
            ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
            ->select('temas.*', 'bancas.nome as banca_nome')
            ->where('temas.id', '=', $id)
            ->first();

        return view('admin.temas.visualizarTema', compact('tema'));
    }

    public function search(Request $request) {
        $search = $request->input('search');

        $temas = DB::table('temas')
            ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
            ->select('temas.*', 'bancas.nome as banca_nome')
            ->when($search, function ($query, $search) {
                return $query->where('temas.frase_tematica', 'ILIKE', "%{$search}%");
            })
            ->paginate(10); // Ensure pagination is still applied

        return view('admin.temas.index', compact('temas'));
    }

    public function adicionar() {
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.temas.adicionar', compact('bancas'));
    }

    public function editar($id) {
        $temas = Temas::findOrFail($id);
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.temas.editar', compact('temas', 'bancas'));
    }

    public function excluir($id) {
        Temas::find($id)->delete();
        return redirect()->route('admin.temas');
    }

    public function salvar(Request $req) {
        $dados = $req->all();  
        Temas::create($dados);
        return redirect()->route('admin.temas');
    }

    public function atualizar(Request $req, $id) {
        $dados = $req->all();
        Temas::find($id)->update($dados);
        return redirect()->route('admin.temas');
    }
    public function store(Request $request)
    {
        $idUser = $_SESSION['id'];

        $idTema = $request->id_tema;

        $perfil = DB::table('users')
        ->join('alunos', 'users.id', '=', 'alunos.id_user')
        ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
        ->select('users.name as name', 'turmas.nome as nome_turma', 'users.email as email', 'users.password as password', 'turmas.id as id_turma', 'alunos.id as id_aluno')            
        ->where('users.id', '=', $idUser)
        ->first();

        $idturma=$perfil->id_turma;
        $idaluno=$perfil->id_aluno;

        $idtema = DB::table('temas')
        ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
        ->select('temas.*', 'temas.id_banca as id_banca', 'temas.id as temas_id') // Select all fields from temas and banca name
        ->where('temas.id', '=', $idTema)
        ->first();

        $id_bancas=$idtema->id_banca;
        // Validar a imagem
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Fazer o upload da imagem
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/redacao_enviada'), $imageName); 

        // Salvar o caminho da imagem no banco de dados
        $image = new Redacoes();
        $image->redacao_enviada = $imageName;
        $image->situacao_redacao= 'Pendente';
        $image->id_banca = $id_bancas;
        $image->id_tema = $idTema;
        $image->id_turma = $idturma;
        $image->id_aluno = $idaluno;
        
        dd($image);
        /*

        if ($image->save()) {
            return back()->with('success', 'Imagem enviada com sucesso!');
        } else {
            return back()->with('error', 'Falha ao salvar a imagem no banco de dados.');
        }
            */
    }
}


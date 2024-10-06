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
            ->orderBy('temas.ano', 'desc')
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
        $url = url()->previous();
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.temas.adicionar', compact('bancas','url'));
    }

    public function editar($id) {
        $url = url()->previous();
        $temas = Temas::join('bancas', 'temas.id_banca', '=', 'bancas.id')
        ->where('temas.id', $id)
        ->select('temas.*', 'bancas.nome as nome_banca')
        ->first();
        $bancas = Bancas::pluck('nome', 'id')->all();
        return view('admin.temas.editar', compact('temas', 'bancas','url'));
    }

    public function excluir($id) {
        Temas::find($id)->delete();
        return redirect()->route('admin.temas');
    }

    public function salvar(Request $req) {
        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/temas'), $filename);
        $req->imagem =  $filename;

        $fraseTematica = $req->input('frase_tematica');
        $textoApoio = $req->input('texto_apoio');
        $ano = $req->input('ano');
        $idBanca = $req->input('id_banca');

        $meuVetor = [
            'frase_tematica' => $fraseTematica,
            'texto_apoio' => $textoApoio,
            'ano' => $ano,
            'id_banca' => $idBanca,
            'imagem' => $filename
            
        ];
        
        Temas::create($meuVetor);

        $url = $req->input('url');
        return redirect()->to($url);
    }

    public function atualizar(Request $req, $id) {
        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/temas'), $filename);
        $req->imagem =  $filename;
        
        $fraseTematica = $req->input('frase_tematica');
        $textoApoio = $req->input('texto_apoio');
        $ano = $req->input('ano');
        $idBanca = $req->input('id_banca');

        $meuVetor = [
            'frase_tematica' => $fraseTematica,
            'texto_apoio' => $textoApoio,
            'ano' => $ano,
            'id_banca' => $idBanca,
            'imagem' => $filename
            
        ];

    
        Temas::find($id)->update($meuVetor);
        $url = $req->input('url');
        return redirect()->to($url);
    }

    public function store(Request $request)
    {
        $idUser = $_SESSION['id'];

        
        $idTema = $request->id_tema;

        $perfil = DB::table('users')
        ->join('alunos', 'users.id', '=', 'alunos.id_user')
        ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
        ->select('turmas.id as id_turma', 'alunos.id as id_aluno')            
        ->where('users.id', '=', $idUser)
        ->first();
    
        $idturma=$perfil->id_turma;
        $idaluno=$perfil->id_aluno;

        $tema = DB::table('temas')
        ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
        ->select( 'temas.id_banca as id_banca') // Select all fields from temas and banca name
        ->where('temas.id', '=', $idTema)
        ->first();

        $id_bancas=$tema->id_banca;
        
        try{
        // Fazer o upload da imagem
        $file = $request->file('redacao_enviada');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/temas'), $filename);

        
        // Salvar o caminho da imagem no banco de dados
        $redacao = new Redacoes();

        $redacao->redacao_enviada =  $filename;
        $redacao->situacao_redacao= 'Pendente';
        $redacao->id_banca = $id_bancas;
        $redacao->id_tema = $idTema;
        $redacao->id_turma = $idturma;
        $redacao->id_aluno = $idaluno;
        
        $redacao->save();

        return redirect()->back()->with('success', 'Redação enviada com sucesso!');
        } catch (\Exception $e) {
            // Exibir mensagem de erro
            return redirect()->back()->with('error', 'Falha ao enviar a redação. Tente novamente.');
        }
    }
}


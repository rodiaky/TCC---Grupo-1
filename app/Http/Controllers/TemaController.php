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

        $bancas = Bancas::pluck('nome', 'id')->all();


        return view('admin.temas.index', compact('temas','bancas'));
    }

    public function visualizarTema($id) {
        $tema = DB::table('temas')
            ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
            ->select('temas.*', 'bancas.nome as banca_nome')
            ->where('temas.id', '=', $id)
            ->first();

        return view('admin.temas.visualizarTema', compact('tema'));
    }

    public function search(Request $request)
    {
        $bancas = Bancas::pluck('nome', 'id')->all();
    
        // Obtém os valores de 'search' e 'id_banca' da requisição
        $search = $request->input('search');
        $idBanca = $request->input('id_banca');
    
        $temas = DB::table('temas')
        ->join('bancas', 'temas.id_banca', '=', 'bancas.id')
        ->select('temas.*', 'bancas.nome as banca_nome')
        ->when($search, function ($query, $search) {
            return $query->where('temas.frase_tematica', 'ILIKE', "%{$search}%");
        })
        ->when($idBanca, function ($query, $idBanca) {
            return $query->where('temas.id_banca', $idBanca);
        })
        ->paginate(10)
        ->appends([
            'search' => $search,
            'id_banca' => $idBanca
        ]);
    
        return view('admin.temas.index', compact('temas', 'bancas'));
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

        $validated = $req->validate([
            'frase_tematica' => 'required|string|max:255', 
            'arquivo' => 'required|file|mimes:pdf', 
            'imagem' => 'required|file|mimes:png', 
            'id_banca' => 'required|integer|exists:bancas,id',
            'ano' => 'required|integer|min:2000',
        ]);
        
        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(('assets/textosApoio'), $filename);
        $req->texto_apoio =  $filename;

        $image = $req->file('imagem');
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/temas'), $imagename);
        $req->imagem =  $imagename;
        
        $fraseTematica = $req->input('frase_tematica');
        $ano = $req->input('ano');
        $idBanca = $req->input('id_banca');

        $meuVetor = [
            'frase_tematica' => $fraseTematica,
            'texto_apoio' => $filename,
            'ano' => $ano,
            'id_banca' => $idBanca,
            'imagem' => $imagename
            
        ];
        
        Temas::create($meuVetor);

        return redirect()->route('admin.temas');
    }

    public function atualizar(Request $req, $id) {
        $validated = $req->validate([
            'frase_tematica' => 'required|string|max:255', 
            'arquivo' => 'required|file|mimes:pdf', 
            'imagem' => 'required|file|mimes:png', 
            'id_banca' => 'required|integer|exists:bancas,id',
            'ano' => 'required|integer|min:2000',
        ]);
        
        $tema = Temas::find($id);
        if($req->hasFile('arquivo')){
            $file = $req->file('arquivo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(('assets/textosApoio'), $filename);
        }else{

            $filename=$tema->texto_apoio;

        }

       
        if($req->hasFile('imagem')){
            $image = $req->file('imagem');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/temas'), $imagename);
        }
        else{
            $imagename=$tema->imagem;
        }
        
        $fraseTematica = $req->input('frase_tematica');
        $ano = $req->input('ano');
        $idBanca = $req->input('id_banca');

        $meuVetor = [
            'frase_tematica' => $fraseTematica,
            'texto_apoio' => $filename,
            'ano' => $ano,
            'id_banca' => $idBanca,
            'imagem' => $imagename
            
        ];

    
        Temas::find($id)->update($meuVetor);
        return redirect()->route('admin.temas');
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
        $file->move(('assets/redacao_enviada'), $filename);

        
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
    public function show($imageName)
    {
        $diretorio ='assets/textosApoio/';

        if (file_exists($diretorio.$imageName)) {
            // Retorna o arquivo PDF
            return response()->file($diretorio.$imageName, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; width= 50%; filename=' . $imageName,
                
            ]);
            /*return view('file', [
                'pdf_url' => asset($diretorio . $imageName)
            ]);*/
        } else {
            // Se o arquivo não existir, retorna uma resposta com status 404
            return response()->json(['error' => 'Arquivo nao encontrado.'], 404);
        }
   
        
    }
}


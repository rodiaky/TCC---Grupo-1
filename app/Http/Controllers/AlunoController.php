<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alunos;
use App\Models\User;
use App\Models\Turmas;
use App\Models\Bancas;
use App\Models\Redações;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function index($id, Request $request) {
        // Consulta para obter todos os alunos da turma
        $pessoas = User::join('alunos', 'users.id', '=', 'alunos.id_user')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->select('users.*', 'alunos.*', 'users.id as id')
            ->where('turmas.id', $id)
            ->get();

        $bancas = Bancas::all();
        $examType = $request->input('exam', '1');
    
        // Nome da turma
        $nome_turma = Turmas::where('id', $id)
            ->pluck('nome')
            ->first();
    
        // Consulta para pegar todas as notas
        $notas = DB::table('redacoes')
            ->join('temas', 'redacoes.id_tema', '=', 'temas.id')
            ->join('bancas', 'redacoes.id_banca', '=', 'bancas.id')
            ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->select(
                'redacoes.nota_aluno_redacao as nota',
                'temas.frase_tematica as frase_tematica',
                'redacoes.id_tema as id_tema',
                'bancas.nome as banca_nome',
                'turmas.id as id_turma',
                'redacoes.id_banca as id_banca',
                'bancas.nota_maxima_banca as nota_maxima'
            )
            ->where('alunos.id_turma', $id) // Filtra pela turma
            ->where('redacoes.id_banca', $examType) 
            ->where('redacoes.situacao_redacao', 'Corrigida') // Apenas corrigidas
            ->orderBy('redacoes.nota_aluno_redacao', 'asc') // Ordena as notas
            ->get();

        if ($notas->isEmpty()) {
            $notasArray = [];
        }
        else{

    
        // Calculando médias por tema
        $temas = $notas->groupBy('id_tema');
        $medias = [];
    
        foreach ($temas as $id_tema => $notasTema) {
            $fraseTematica = $notasTema->first()->frase_tematica;
            $mediaTema = $notasTema->avg('nota'); // Calcula a média das notas para o tema
            $medias[$fraseTematica] = $mediaTema;
        }
    
        // Obtendo a nota máxima da banca
        $notaMaxima = DB::table('bancas')
            ->where('id', $notas->first()->id_banca)
            ->value('nota_maxima_banca') ?? 0;
    
       // Preparar dados para JavaScript
       $notasArray = [];
       $notasArray[] = ['Frase Temática', 'Média da Sala', 'Nota Máxima'];
       foreach ($medias as $fraseTematica => $media) {
        $notasArray[] = [
            $fraseTematica,
            number_format(10, 2),
            number_format($media, 2),
            $notaMaxima
        ];
    
       }
    }

       if ($request->ajax()) {
           return response()->json($notasArray);
       }

        // Passando as variáveis para a view
        return view('admin.alunos.index', compact('pessoas', 'nome_turma','examType', 'notasArray', 'bancas'));

    }
    
    
    
    public function adicionar() {
        $turmas = Turmas::pluck('nome', 'id')->all();
        return view('admin.alunos.adicionar', compact('turmas'));
    }
    
    public function editar($id_pessoa) {
        $url = url()->previous();

        $alunos = DB::table('users')
        ->join('alunos', 'users.id', '=', 'alunos.id_user')
        ->join('turmas', 'alunos.id_turma', '=', 'turmas.id') 
        ->select('users.*', 'alunos.*', 'turmas.nome as nome_turma', 'users.id as id', 'turmas.id as id_turma') 
        ->where('users.id', $id_pessoa)
        ->first();

        $id = $alunos->id_turma;
 
        $turmas = Turmas::pluck('nome', 'id')->all();
    
  
        return view('admin.alunos.editar', compact('alunos', 'turmas','id','url'));
    }
    
    
    public function excluir($id_pessoa) {
        $user = User::find($id_pessoa);
        $id_turma = Alunos::where('id_user', $id_pessoa)
            ->pluck('id_turma')
            ->first();
        if ($user) {
            $user->delete();
            return redirect()->route('professor.admin.alunos', ['id' => $id_turma])->with('success', 'Aluno excluído com sucesso.');
        }
        return redirect()->route('professor.admin.alunos', ['id' => $id_turma])->with('error', 'Aluno não encontrado.');
    }
    
    
    public function salvar(Request $req) {
        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(('assets/fotoPerfil'), $filename);
        $req->foto =  $filename;

        $nome = $req->input('name');
        $email = $req->input('email');
        $senha = $req->input('password');
        $id_turma= $req->input('id_turma');
        
        $meuVetor = [
            'name' => $nome,
            'foto' => $filename,
            'eh_admin' => "Aluno",
            'email' =>  $email,
            'password' => $senha     
        ];

        User::create($meuVetor);
        $ultimoId = User::latest()->value('id');
        $aluno = new Alunos();
        $aluno->id_turma = $id_turma; 
        $aluno->id_user = $ultimoId; 
        $aluno->save();
        
        return redirect()->route('admin.turmas');
    }
    
    public function atualizar(Request $request, $id)
    {
        $alunoAtual = User::find($id);
            if ($request->hasFile('arquivo')) {
                // Se um novo arquivo foi enviado, armazena o novo arquivo
                $image = $request->file('arquivo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(('assets/fotoPerfil'), $imageName);
            } else {
                // Se não foi enviado um novo arquivo, mantém o arquivo existente
                $imageName = $alunoAtual->foto; // Nome do arquivo atual
            }

        $aluno = $_SESSION['eh_admin'] === 'Aluno';
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'id_turma' => 'required|exists:turmas,id',
        ]);

        // Tente encontrar o aluno com base no ID do usuário
        $aluno = Alunos::where('id_user', $id)->first();

        // Verifica se o aluno foi encontrado
        if (!$aluno) {
            return redirect()->route('professor.admin.alunos', ['id' => $request->id_turma])
                            ->with('error', 'Aluno não encontrado.');
        }

        // Armazena o ID da turma anterior
        $id_turma_antiga = $aluno->id_turma;

        // Atualiza a turma do aluno
        $aluno->id_turma = $request->id_turma; 

        // Atualiza também o nome do usuário
        $user = User::findOrFail($id); 
        $user->name = $request->name;
        $user->email=$request->email;
        $user->foto = $imageName;

        // Salva as alterações
        $userSaved = $user->save();
        $alunoSaved = $aluno->save();

        // Verifica se as alterações foram salvas
        if (!$userSaved || !$alunoSaved) {
            return redirect()->back()->with('error', 'Erro ao atualizar os dados do aluno.')->withInput();
        }

        // Redireciona para a página de alunos da turma anterior com uma mensagem de sucesso
        if(!$aluno){
        return redirect()->route('professor.admin.alunos', ['id' => $id_turma_antiga])
                        ->with('success', 'Aluno atualizado com sucesso.');
        }
        else{
            $url = $request->input('url');
            return redirect()->to($url);
        }
}

    public function completo(){
        
    }

}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AlunoMiddleware;
use App\Http\Middleware\ProfessorMiddleware;
use App\Http\Middleware\AdministradorMiddleware;
use App\Http\Middleware\AutenticacaoMiddleware;
use App\Http\Controllers\RedacoesPendentesController;
use App\Http\Controllers\RedacoesCorrigidasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlterarSenhaController;
use App\Http\Controllers\HomeProfessorController;
use App\Http\Controllers\CadastroAlunoController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\TemaRepertoriosController;
use App\Http\Controllers\RepertoriosController;
use App\Http\Controllers\QuestoesController;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PastaMateriaisController;
use App\Http\Controllers\MateriaisController;
use App\Http\Controllers\PerfilController;

// Auth Routes
Auth::routes();
Route::get('/logout', [LoginController::class, 'sair'])->name('logout');

// Public Routes
Route::get('/', function () { return view('welcome'); });

/*Route::get('/turma', [TurmasController::class, 'index'])->name('site.turmas');
Route::get('/turma_adicionar', [TurmasController::class, 'adicionar'])->name('site.turmas.adicionar');
Route::post('/site/turmas/salvar', [TurmasController::class, 'salvar'])->name('site.turmas.salvar');
Route::get('/site/turmas/editar/{id}', [TurmasController::class, 'editar'])->name('site.turmas.editar');
Route::match(['get', 'post'], '/site/turmas/atualizar/{id}', [TurmasController::class, 'atualizar'])->name('site.turmas.atualizar');
Route::get('/site/turmas/excluir/{id}', [TurmasController::class, 'excluir'])->name('site.turmas.excluir');*/

// Aluno Routes
Route::name('aluno.')->middleware(AlunoMiddleware::class)->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/alterar_senha', [AlterarSenhaController::class, 'index'])->name('alterar_senha');
    Route::post('/alterar_senha', [AlterarSenhaController::class, 'update'])->name('alterar_senha.update');
    Route::get('/painel_redacoes', function () { return view('site.aluno.painel_redacoes'); })->name('painel_redacoes');
   
});

// Professor Routes
Route::name('professor.')->middleware(ProfessorMiddleware::class)->group(function() {
    Route::get('/home_professor', [HomeProfessorController::class, 'index'])->name('home');
    Route::get('/turmas', function () { return view('site.professor.turmas'); })->name('turmas');
    Route::get('/redacoes_pendentes', [RedacoesPendentesController::class, 'index'])->name('redPendentes');
    Route::get('/cadastrar_aluno', [CadastroAlunoController::class, 'index'])->name('cadastroAluno.index');
    Route::post('/cadastrar_aluno', [CadastroAlunoController::class, 'store'])->name('cadastroAluno.store');
});
// Autenticacao Middleware Routes
Route::middleware(AutenticacaoMiddleware::class)->group(function() {
    Route::get('/redacao_corrigida/{id}',[RedacoesCorrigidasController::class,'view'])->name('redacao_corrigida');

    Route::get('/perfilA', [PerfilController::class, 'indexAluno'])->name('perfil.aluno');
    Route::get('/perfilP', [PerfilController::class, 'indexProfessor'])->name('perfil.professor');

    Route::get('/temas_redacoes', [TemaController::class, 'index'])->name('temaRedacoes');
    Route::get('/temas_repertorios', [TemaRepertoriosController::class, 'index'])->name('temaRepertorios');
    Route::get('/view/{is}', [RedacoesPendentesController::class, 'view']);
    Route::post('/save-image', [RedacoesPendentesController::class, 'saveImage'])->name('save.image');
    Route::post('/uploadproduct', [RedacoesPendentesController::class, 'store']);
    Route::post('/save-edited-image/{id}', [RedacoesPendentesController::class, 'saveImage']);

    // Admin Routes
    Route::prefix('admin')->group(function() {
        Route::prefix('temas')->group(function() {
            Route::get('/', [TemaController::class, 'index'])->name('admin.temas');
            Route::get('/pesquisar', [TemaController::class, 'search'])->name('admin.temas.search');
            Route::get('/adicionar', [TemaController::class, 'adicionar'])->name('admin.temas.adicionar');
            Route::post('/salvar', [TemaController::class, 'salvar'])->name('admin.temas.salvar');
            Route::get('/editar/{id}', [TemaController::class, 'editar'])->name('admin.temas.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [TemaController::class, 'atualizar'])->name('admin.temas.atualizar');
            Route::get('/excluir/{id}', [TemaController::class, 'excluir'])->name('admin.temas.excluir');
            Route::get('/visualizarTema/{id}', [TemaController::class, 'visualizarTema'])->name('admin.temas.visualizar');
            Route::post('/store', [TemaController::class, 'store'])->name('admin.temas.store');
        });

        Route::prefix('turmas')->group(function() {
            Route::get('/', [TurmasController::class, 'index'])->name('admin.turmas');
            Route::get('/adicionar', [TurmasController::class, 'adicionar'])->name('admin.turmas.adicionar');
            Route::post('/salvar', [TurmasController::class, 'salvar'])->name('admin.turmas.salvar');
            Route::get('/editar/{id}', [TurmasController::class, 'editar'])->name('admin.turmas.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [TurmasController::class, 'atualizar'])->name('admin.turmas.atualizar');
            Route::get('/excluir/{id}', [TurmasController::class, 'excluir'])->name('admin.turmas.excluir');            
        });

        Route::prefix('questoes')->group(function() {
            Route::get('/', [QuestoesController::class, 'index'])->name('admin.questoes');
            Route::get('/gramatica', [QuestoesController::class, 'gramatica'])->name('admin.questoes.gramatica');
            Route::get('/literatura', [QuestoesController::class, 'literatura'])->name('admin.questoes.literatura');
            Route::get('/interpretacao', [QuestoesController::class, 'interpretacao'])->name('admin.questoes.interpretacao');
            Route::get('/adicionar', [QuestoesController::class, 'adicionar'])->name('admin.questoes.adicionar');
            Route::post('/salvar', [QuestoesController::class, 'salvar'])->name('admin.questoes.salvar');
            Route::get('/editar/{id}', [QuestoesController::class, 'editar'])->name('admin.questoes.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [QuestoesController::class, 'atualizar'])->name('admin.questoes.atualizar');
            Route::get('/excluir/{id}', [QuestoesController::class, 'excluir'])->name('admin.questoes.excluir');
        });

        Route::prefix('repertorios')->group(function() {
            Route::get('/{id}', [RepertoriosController::class, 'index'])->name('admin.repertorios');
            Route::get('/pesquisar', [RepertoriosController::class, 'search'])->name('admin.repertorios.search');
            Route::get('/visualizar/{id}/{id_pasta}', [RepertoriosController::class, 'visualizar'])->name('admin.repertorios.visualizar');
            Route::get('/adicionar', [RepertoriosController::class, 'adicionar'])->name('admin.repertorios.adicionar');
            Route::post('/salvar', [RepertoriosController::class, 'salvar'])->name('admin.repertorios.salvar');
            Route::get('/editar/{id}', [RepertoriosController::class, 'editar'])->name('admin.repertorios.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [RepertoriosController::class, 'atualizar'])->name('admin.repertorios.atualizar');
            Route::get('/excluir/{id}', [RepertoriosController::class, 'excluir'])->name('admin.repertorios.excluir');
        });

        Route::prefix('materiais')->group(function() {
            Route::get('/{id}', [MateriaisController::class, 'index'])->name('admin.materiais');
            Route::get('/pesquisar', [MateriaisController::class, 'search'])->name('admin.materiais.search');
            Route::get('/filtrar', [MateriaisController::class, 'filtrar'])->name('admin.materiais.filtrar');
            Route::get('/visualizar/{id}/{id_pasta}', [MateriaisController::class, 'visualizar'])->name('admin.materiais.visualizar');
            Route::get('/adicionar', [MateriaisController::class, 'adicionar'])->name('admin.materiais.adicionar');
            Route::post('/salvar', [MateriaisController::class, 'salvar'])->name('admin.materiais.salvar');
            Route::get('/editar/{id}', [MateriaisController::class, 'editar'])->name('admin.materiais.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [MateriaisController::class, 'atualizar'])->name('admin.materiais.atualizar');
            Route::get('/excluir/{id}', [MateriaisController::class, 'excluir'])->name('admin.materiais.excluir');
        });

        
        
    

        Route::prefix('temasRepertorios')->group(function() {
            Route::get('/', [TemaRepertoriosController::class, 'index'])->name('admin.temasRepertorios');
            Route::get('/adicionar', [TemaRepertoriosController::class, 'adicionar'])->name('admin.temasRepertorios.adicionar');
            Route::post('/salvar', [TemaRepertoriosController::class, 'salvar'])->name('admin.temasRepertorios.salvar');
            Route::get('/editar/{id}', [TemaRepertoriosController::class, 'editar'])->name('admin.temasRepertorios.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [TemaRepertoriosController::class, 'atualizar'])->name('admin.temasRepertorios.atualizar');
            Route::get('/excluir/{id}', [TemaRepertoriosController::class, 'excluir'])->name('admin.temasRepertorios.excluir');            
        });

        Route::prefix('pastasMateriais')->group(function() {
            Route::get('/', [PastaMateriaisController::class, 'index'])->name('admin.pastasMateriais');
            Route::get('/adicionar', [PastaMateriaisController::class, 'adicionar'])->name('admin.pastasMateriais.adicionar');
            Route::post('/salvar', [PastaMateriaisController::class, 'salvar'])->name('admin.pastasMateriais.salvar');
            Route::get('/editar/{id}', [PastaMateriaisController::class, 'editar'])->name('admin.pastasMateriais.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [PastaMateriaisController::class, 'atualizar'])->name('admin.pastasMateriais.atualizar');
            Route::get('/excluir/{id}', [PastaMateriaisController::class, 'excluir'])->name('admin.pastasMateriais.excluir');            
        });

        Route::prefix('carregarSemana')->group(function() {
            Route::get('/', [PastaMateriaisController::class, 'index'])->name('admin.carregarSemana');
        });
    });

    // Other Routes
    Route::get('/repertorios', [RepertoriosController::class, 'index'])->name('repertorios');
   
    // Rota para buscar repertórios (pesquisa)
    Route::get('/repertorios/pesquisar', [RepertoriosController::class, 'search'])->name('admin.repertorios.search');
    Route::get('/repertorios/filtrar', [RepertoriosController::class, 'filtrar'])->name('admin.repertorios.filtrar');
    
    // Redacoes Pendentes Routes
    Route::get('/view/{is}', [RedacoesPendentesController::class, 'view']);
    Route::post('/save-image', [RedacoesPendentesController::class, 'saveImage'])->name('save.image');
    Route::post('/uploadproduct', [RedacoesPendentesController::class, 'store']);
    Route::post('/save-edited-image/{id}', [RedacoesPendentesController::class, 'saveImage']);

    Route::match(['get','post'],'/admin/correcao/atualizar/{id}', ['as' =>'admin.correcao.atualizar', 'uses' => 'App\Http\Controllers\RedacoesPendentesController@atualizar']);

// Other Pages
    Route::get('/pasta_materiais', function () { return view('site.matPasta'); })->name('matPasta');
    Route::get('/materiais', function () { return view('site.materiais'); })->name('materiais');
});

// Admin Routes
Route::middleware(AdministradorMiddleware::class)->group(function() {
    // Add routes specific to administrators here
});

// Resource Route
Route::resource('tarefa', TarefaController::class);

// Redacoes Pendentes Routes

//Redacoes_corrigidas alunos




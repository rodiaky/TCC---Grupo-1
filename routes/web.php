<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AlunoMiddleware;
use App\Http\Middleware\ProfessorMiddleware;
use App\Http\Middleware\AdministradorMiddleware;
use App\Http\Middleware\AutenticacaoMiddleware;
use App\Http\Controllers\RedacoesPendentesController;
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

// Auth Routes
Route::name('aluno.')->middleware(AlunoMiddleware::class)->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/alterar_senha', [App\Http\Controllers\AlterarSenhaController::class, 'index'])->name('alterar_senha');
    Route::post('/alterar_senha', [App\Http\Controllers\AlterarSenhaController::class, 'update'])->name('alterar_senha.update');
    Route::get('/painel_redacoes', function () {return view('site.aluno.painel_redacoes');})->name('painel_redacoes');
});

Route::name('professor.')->middleware(ProfessorMiddleware::class)->group(function() {
    Route::get('/home_professor', [App\Http\Controllers\HomeProfessorController::class, 'index'])->name('home');
    Route::get('/turmas', function () {return view('site.professor.turmas');})->name('turmas')->name('turmas');
    Route::get('/redacoes_pendentes', [App\Http\Controllers\RedacoesPendentesController::class, 'index'])->name('redPendentes');

    Route::get('/cadastrar_aluno', [App\Http\Controllers\CadastroAlunoController::class, 'index'])->name('cadastroAluno.index');
    Route::post('/cadastrar_aluno', [App\Http\Controllers\CadastroAlunoController::class, 'store'])->name('cadastroAluno.store');

    Route::get('/pasta_materiais', function () {return view('site.professor.matPasta');})->name('matPasta');
    Route::get('/materiais', function () {return view('site.professor.materiais');})->name('materiais');
});

Route::name('')->middleware(AutenticacaoMiddleware::class)->group(function() {
    Route::get('/temas_redacoes', [App\Http\Controllers\TemaController::class, 'index'])->name('temaRedacoes');
    Route::get('/temas_repertorios', [App\Http\Controllers\TemaRepertoriosController::class, 'index'])->name('temaRepertorios');
    Route::get('/admin/temas', ['as' =>'admin.temas', 'uses' => 'App\Http\Controllers\TemaController@index']);
    Route::get('/admin/temas/pesquisar', ['as' => 'admin.temas.search','uses' => 'App\Http\Controllers\TemaController@search']);
    Route::get('/admin/temas/adicionar', ['as' =>'admin.temas.adicionar', 'uses' => 'App\Http\Controllers\TemaController@adicionar']);
    Route::post('/admin/temas/salvar', ['as' =>'admin.temas.salvar', 'uses' => 'App\Http\Controllers\TemaController@salvar'])->middleware(ProfessorMiddleware::class);
    Route::get('/admin/temas/editar/{id}', ['as' =>'admin.temas.editar', 'uses' => 'App\Http\Controllers\TemaController@editar'])->middleware(ProfessorMiddleware::class);
    Route::match(['get','post'],'/admin/temas/atualizar/{id}', ['as' =>'admin.temas.atualizar', 'uses' => 'App\Http\Controllers\TemaController@atualizar'])->middleware(ProfessorMiddleware::class);
    Route::get('/admin/temas/excluir/{id}', ['as' =>'admin.temas.excluir', 'uses' => 'App\Http\Controllers\TemaController@excluir'])->middleware(ProfessorMiddleware::class);

    // Rota para listar repertórios
    Route::get('/repertorios', [RepertoriosController::class, 'index'])->name('repertorios');

    // Rota para buscar repertórios (pesquisa)
    Route::get('/repertorios/pesquisar', [RepertoriosController::class, 'search'])->name('admin.repertorios.search');
    Route::get('/repertorios/filtrar', [RepertoriosController::class, 'filtrar'])->name('admin.repertorios.filtrar');

    // Rota para visualizar um repertório específico pelo ID
    Route::get('/repertorios/{id}', [RepertoriosController::class, 'vizualizar'])->name('repertorios.vizualizar');

    // Rota para editar um repertório
    Route::get('/repertorios/editar/{id}', [RepertoriosController::class, 'editar'])->name('repertorios.editar');

    // Rota para excluir um repertório
    Route::get('/repertorios/excluir/{id}', [RepertoriosController::class, 'excluir'])->name('repertorios.excluir');

    // Outras rotas
    Route::get('/questoes', [QuestoesController::class, 'index'])->name('questoes');   
    Route::get('/banca_questoes', [BancaQuestoesController::class, 'index'])->name('bancaQuestoes');

    //questoes
  Route::get('/admin/questoes', ['as' =>'admin.questoes', 'uses' => 'App\Http\Controllers\QuestoesController@index']);
  Route::get('/admin/questoes/gramatica', ['as' => 'admin.questoes.gramatica','uses' => 'App\Http\Controllers\QuestoesController@gramatica']);
  Route::get('/admin/questoes/literatura', ['as' => 'admin.questoes.literatura','uses' => 'App\Http\Controllers\QuestoesController@literatura']);
  Route::get('/admin/questoes/interpretacao', ['as' => 'admin.questoes.interpretacao','uses' => 'App\Http\Controllers\QuestoesController@interpretacao']);
  Route::get('/admin/questoes/adicionar', ['as' =>'admin.questoes.adicionar', 'uses' => 'App\Http\Controllers\QuestoesController@adicionar']);
  Route::post('/admin/questoes/salvar', ['as' =>'admin.questoes.salvar', 'uses' => 'App\Http\Controllers\QuestoesController@salvar']);
  Route::get('/admin/questoes/editar/{id}', ['as' =>'admin.questoes.editar', 'uses' => 'App\Http\Controllers\QuestoesController@editar']);
  Route::match(['get','post'],'/admin/questoes/atualizar/{id}', ['as' =>'admin.questoes.atualizar', 'uses' => 'App\Http\Controllers\QuestoesController@atualizar']);
  Route::get('/admin/questoes/excluir/{id}', ['as' =>'admin.questoes.excluir', 'uses' => 'App\Http\Controllers\QuestoesController@excluir']);


    //temas
  Route::get('/admin/temas', ['as' =>'admin.temas', 'uses' => 'App\Http\Controllers\TemaController@index']);
  Route::get('/admin/temas/pesquisar', ['as' => 'admin.temas.search','uses' => 'App\Http\Controllers\TemaController@search']);
  Route::get('/admin/temas/adicionar', ['as' =>'admin.temas.adicionar', 'uses' => 'App\Http\Controllers\TemaController@adicionar']);
  Route::post('/admin/temas/salvar', ['as' =>'admin.temas.salvar', 'uses' => 'App\Http\Controllers\TemaController@salvar']);
  Route::get('/admin/temas/editar/{id}', ['as' =>'admin.temas.editar', 'uses' => 'App\Http\Controllers\TemaController@editar']);
  Route::match(['get','post'],'/admin/temas/atualizar/{id}', ['as' =>'admin.temas.atualizar', 'uses' => 'App\Http\Controllers\TemaController@atualizar']);
  Route::get('/admin/temas/excluir/{id}', ['as' =>'admin.temas.excluir', 'uses' => 'App\Http\Controllers\TemaController@excluir']);

  Route::match(['get','post'],'/admin/correcao/atualizar/{id}', ['as' =>'admin.correcao.atualizar', 'uses' => 'App\Http\Controllers\RedacoesPendentesController@atualizar']);
});

Route::middleware('administrador')->middleware(AdministradorMiddleware::class)->group(function() {
});

Route::resource('tarefa', 'App\Http\Controllers\TarefaController');

// Auth Routes
Auth::routes();
Route::get('/logout', [LoginController::class, 'sair'])->name('logout');

// Public Routes
Route::get('/', function () { return view('welcome'); });
Route::get('/turma', [TurmasController::class, 'index'])->name('site.turmas');
Route::get('/turma_adicionar', [TurmasController::class, 'adicionar'])->name('site.turmas.adicionar');
Route::post('/site/turmas/salvar', [TurmasController::class, 'salvar'])->name('site.turmas.salvar');
Route::get('/site/turmas/editar/{id}', [TurmasController::class, 'editar'])->name('site.turmas.editar');
Route::match(['get', 'post'], '/site/turmas/atualizar/{id}', [TurmasController::class, 'atualizar'])->name('site.turmas.atualizar');
Route::get('/site/turmas/excluir/{id}', [TurmasController::class, 'excluir'])->name('site.turmas.excluir');

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
    Route::get('/temas_redacoes', [TemaController::class, 'index'])->name('temaRedacoes');
    Route::get('/temas_repertorios', [TemaRepertoriosController::class, 'index'])->name('temaRepertorios');

    // Admin Routes
    Route::prefix('admin')->middleware(ProfessorMiddleware::class)->group(function() {
        Route::prefix('temas')->group(function() {
            Route::get('/', [TemaController::class, 'index'])->name('admin.temas');
            Route::get('/pesquisar', [TemaController::class, 'search'])->name('admin.temas.search');
            Route::get('/adicionar', [TemaController::class, 'adicionar'])->name('admin.temas.adicionar');
            Route::post('/salvar', [TemaController::class, 'salvar'])->name('admin.temas.salvar');
            Route::get('/editar/{id}', [TemaController::class, 'editar'])->name('admin.temas.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [TemaController::class, 'atualizar'])->name('admin.temas.atualizar');
            Route::get('/excluir/{id}', [TemaController::class, 'excluir'])->name('admin.temas.excluir');
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
    });

    // Other Routes
    Route::get('/repertorios', [RepertoriosController::class, 'index'])->name('repertorios');
    Route::get('/repertorios/{id}', [RepertoriosController::class, 'vizualizar'])->name('repertorios.vizualizar');
    Route::get('/repertorios/editar/{id}', [RepertoriosController::class, 'editar'])->name('repertorios.editar');
    Route::get('/repertorios/excluir/{id}', [RepertoriosController::class, 'excluir'])->name('repertorios.excluir');
  

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
Route::get('/view/{is}', [RedacoesPendentesController::class, 'view']);
Route::post('/save-image', [RedacoesPendentesController::class, 'saveImage'])->name('save.image');
Route::post('/uploadproduct', [RedacoesPendentesController::class, 'store']);
Route::post('/save-edited-image/{id}', [RedacoesPendentesController::class, 'saveImage']);


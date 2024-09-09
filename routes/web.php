<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\AlunoMiddleware;
use \App\Http\Middleware\ProfessorMiddleware;
use \App\Http\Middleware\AdministradorMiddleware;
use \App\Http\Middleware\AutenticacaoMiddleware;
use App\Http\Controllers\RedacoesPendentesController;

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

    Route::get('/repertorios', [App\Http\Controllers\RepertoriosController::class, 'index'])->name('repertorios');
    Route::get('/questoes', [App\Http\Controllers\QuestoesController::class, 'index'])->name('questoes');   
    Route::get('/banca_questoes', [App\Http\Controllers\BancaQuestoesController::class, 'index'])->name('bancaQuestoes');  
    Route::get('/repertorios/{id}', [App\Http\Controllers\RepertoriosController::class, 'vizualizar'])->name('repertorios.vizualizar');

    Route::get('/repertorios/{id}', [App\Http\Controllers\RepertoriosController::class, 'vizualizar'])->name('repertorios.vizualizar');
    Route::get('/repertorios', [App\Http\Controllers\RepertoriosController::class, 'index'])->name('repertorios');
    Route::get('/repertorios/editar/{id}', [App\Http\Controllers\RepertoriosController::class, 'editar'])->name('repertorios.editar');
    Route::get('/repertorios/excluir/{id}', [App\Http\Controllers\RepertoriosController::class, 'excluir'])->name('repertorios.excluir');

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
});

Route::middleware('administrador')->middleware(AdministradorMiddleware::class)->group(function() {
});

Route::resource('tarefa', 'App\Http\Controllers\TarefaController');

Auth::routes();

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'sair']) ->name('logout');

Route::get('/', function () { return view('welcome');});

Route::get('/turma', ['as' =>'site.turmas', 'uses' => 'App\Http\Controllers\TurmasController@index']);
Route::get('/turma_adicionar', [App\Http\Controllers\TurmasController::class, 'adicionar'])->name('site.turmas.adicionar');
Route::post('/site/turmas/salvar', ['as' =>'site.turmas.salvar', 'uses' => 'App\Http\Controllers\TurmasController@salvar']);
Route::get('/site/turmas/editar/{id}', ['as' =>'site.turmas.editar', 'uses' => 'App\Http\Controllers\TurmasController@editar']);
Route::match(['get','post'],'/site/turmas/atualizar/{id}', ['as' =>'site.turmas.atualizar', 'uses' => 'App\Http\Controllers\TurmasController@atualizar']);
Route::get('/site/turmas/excluir/{id}', ['as' =>'site.turmas.excluir', 'uses' => 'App\Http\Controllers\TurmasController@excluir']);   


Route::get('/view/{is}',[RedacoesPendentesController::class,'view']);
Route::post('/save-image', [RedacoesPendentesController::class, 'saveImage'])->name('save.image');
Route::post('/uploadproduct',[RedacoesPendentesController::class,'store']);
Route::post('/save-edited-image/{id}', [RedacoesPendentesController::class, 'saveImage']);


<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\AlunoMiddleware;
use \App\Http\Middleware\ProfessorMiddleware;
use \App\Http\Middleware\AdministradorMiddleware;
use \App\Http\Middleware\AutenticacaoMiddleware;

Route::name('aluno.')->middleware(AlunoMiddleware::class)->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/painel_redacoes', function () {return view('site.aluno.painel_redacoes');})->name('painel_redacoes');
});

Route::name('professor.')->middleware(ProfessorMiddleware::class)->group(function() {
    Route::get('/home_professor', [App\Http\Controllers\HomeProfessorController::class, 'index'])->name('home');
    Route::get('/turmas', function () {return view('site.professor.turmas');})->name('turmas')->name('turmas');
    Route::get('/redacoes_pendentes', [App\Http\Controllers\RedacoesPendentesController::class, 'index'])->name('redPendentes');
    Route::get('/cadastrar_aluno', function () {return view('site.professor.cadastroAluno');})->name('cadastroAluno');
    Route::get('/pasta_materiais', function () {return view('site.professor.matPasta');})->name('matPasta');
    Route::get('/materiais', function () {return view('site.professor.materiais');})->name('materiais');
});

Route::name('')->middleware(AutenticacaoMiddleware::class)->group(function() {
    Route::get('/temas_redacoes', [App\Http\Controllers\TemaController::class, 'index'])->name('temaRedacoes');
    Route::get('/temas_repertorios', [App\Http\Controllers\TemaRepertoriosController::class, 'index'])->name('temaRepertorios');
    Route::get('/repertorios', [App\Http\Controllers\RepertoriosController::class, 'index'])->name('repertorios');
    Route::get('/questoes', [App\Http\Controllers\QuestoesController::class, 'index'])->name('questoes');   
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
Route::get('/redpendentes',[RedacoesPendentesController::class,'redpen']);
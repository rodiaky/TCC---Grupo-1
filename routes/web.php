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
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CriterioController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\SemanaController;
use App\Http\Controllers\EstatisticaController;
use App\Http\Controllers\MinhasRedacoesController;
use App\Http\Controllers\AlunoIndividualController;
use App\Http\Controllers\PagamentoController;

// Auth Routes
Auth::routes();
Route::get('/logout', [LoginController::class, 'sair'])->name('logout');

// Public Routes
Route::get('/', function () { return view('welcome'); });
Route::get('/', function () { return view('welcome'); })->name('welcome');

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
    Route::get('/painel_redacoes', [MinhasRedacoesController::class, 'index'])->name('painel_redacoes');
    Route::get('/estatistica', [EstatisticaController::class, 'index'])->name('estatistica');
   
});

// Professor Routes
Route::name('professor.')->middleware(ProfessorMiddleware::class)->group(function() {
    Route::get('/home_professor', [HomeProfessorController::class, 'index'])->name('home');
    Route::get('/redacoes_pendentes', [RedacoesPendentesController::class, 'index'])->name('redPendentes');
    Route::get('/cadastrar_aluno', [CadastroAlunoController::class, 'index'])->name('cadastroAluno.index');
    Route::post('/cadastrar_aluno', [CadastroAlunoController::class, 'store'])->name('cadastroAluno.store');

    Route::get('/admin/alunos/{id}', ['as' =>'admin.alunos', 'uses' => 'App\Http\Controllers\AlunoController@index']);
    Route::get('/admin/alunos/adicionar', ['as' =>'admin.alunos.adicionar', 'uses' => 'App\Http\Controllers\AlunoController@adicionar']);
    Route::post('/admin/alunos/salvar', ['as' =>'admin.alunos.salvar', 'uses' => 'App\Http\Controllers\AlunoController@salvar']);
    Route::get('/admin/alunos/editar/{id}', ['as' =>'admin.alunos.editar', 'uses' => 'App\Http\Controllers\AlunoController@editar']);
    Route::put('/admin/alunos/atualizar/{id}', ['as' => 'admin.alunos.atualizar', 'uses' => 'App\Http\Controllers\AlunoController@atualizar']);
    Route::delete('admin/alunos/excluir/{id}', [AlunoController::class, 'excluir'])->name('admin.alunos.excluir');

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

    Route::get('/cruds', function () { return view('site.cruds'); })->name('admin.cruds');

    Route::get('/home', [HomeController::class, 'index'])->name('aluno.home');
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
            Route::get('/aluno/{id}', [AlunoIndividualController::class, 'index'])->name('admin.turmas.aluno');         
        });

        Route::prefix('alunos')->group(function() {
            Route::get('/{id}', [AlunoController::class, 'index'])->name('admin.alunos');
            Route::get('/1/adicionar', [AlunoController::class, 'adicionar'])->name('admin.alunos.adicionar');
            Route::post('/salvar', [AlunoController::class, 'salvar'])->name('admin.alunos.salvar');
            Route::get('/editar/{id}', [AlunoController::class, 'editar'])->name('admin.alunos.editar');
            Route::get('/cadastroCompleto/{id}', [AlunoController::class, 'completo'])->name('admin.alunos.completo');
            Route::match(['get', 'post'], '/atualizar/{id}', [AlunoController::class, 'atualizar'])->name('admin.alunos.atualizar');
            Route::get('/excluir/{id}', [AlunoController::class, 'excluir'])->name('admin.alunos.excluir');            
        });

        Route::prefix('semanas')->group(function() {
            Route::get('/', [SemanaController::class, 'index'])->name('admin.semanas');
            Route::get('/adicionar', [SemanaController::class, 'adicionar'])->name('admin.semanas.adicionar');
            Route::post('/salvar', [SemanaController::class, 'salvar'])->name('admin.semanas.salvar');
            Route::get('/editar/{id}', [SemanaController::class, 'editar'])->name('admin.semanas.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [SemanaController::class, 'atualizar'])->name('admin.semanas.atualizar');
            Route::get('/excluir/{id}', [SemanaController::class, 'excluir'])->name('admin.semanas.excluir');            
        });

        Route::prefix('bancas')->group(function() {
            Route::get('/', [BancaController::class, 'index'])->name('admin.bancas');
            Route::get('/adicionar', [BancaController::class, 'adicionar'])->name('admin.bancas.adicionar');
            Route::post('/salvar', [BancaController::class, 'salvar'])->name('admin.bancas.salvar');
            Route::get('/editar/{id}', [BancaController::class, 'editar'])->name('admin.bancas.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [BancaController::class, 'atualizar'])->name('admin.bancas.atualizar');
            Route::get('/excluir/{id}', [BancaController::class, 'excluir'])->name('admin.bancas.excluir');            
        });

        Route::prefix('pagamentos')->group(function() {
            Route::get('/adicionar', [PagamentoController::class, 'adicionar'])->name('admin.pagamentos.adicionar');
            Route::post('/salvar', [PagamentoController::class, 'salvar'])->name('admin.pagamentos.salvar');
            Route::get('/editar/{id}', [PagamentoController::class, 'editar'])->name('admin.pagamentos.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [PagamentoController::class, 'atualizar'])->name('admin.pagamentos.atualizar');
            Route::get('/excluir/{id}', [PagamentoController::class, 'excluir'])->name('admin.pagamentos.excluir');            
        });

        Route::prefix('criterios')->group(function() {
            Route::get('/', [CriterioController::class, 'index'])->name('admin.criterios');
            Route::get('/adicionar', [CriterioController::class, 'adicionar'])->name('admin.criterios.adicionar');
            Route::post('/salvar', [CriterioController::class, 'salvar'])->name('admin.criterios.salvar');
            Route::get('/editar/{id}', [CriterioController::class, 'editar'])->name('admin.criterios.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [CriterioController::class, 'atualizar'])->name('admin.criterios.atualizar');
            Route::get('/excluir/{id}', [CriterioController::class, 'excluir'])->name('admin.criterios.excluir');            
        });


        Route::prefix('questoes')->group(function() {
            Route::get('/', [QuestoesController::class, 'index'])->name('admin.questoes');
            Route::get('/gramatica', [QuestoesController::class, 'gramatica'])->name('admin.questoes.gramatica');
            Route::get('/literatura', [QuestoesController::class, 'literatura'])->name('admin.questoes.literatura');
            Route::get('/interpretacao', [QuestoesController::class, 'interpretacao'])->name('admin.questoes.interpretacao');
            Route::get('/filtrar', [QuestoesController::class, 'filtrar'])->name('admin.questoes.filtrar');
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
            Route::get('/1/adicionar', [RepertoriosController::class, 'adicionar'])->name('admin.repertorios.adicionar');
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
            Route::get('/1/adicionar', [MateriaisController::class, 'adicionar'])->name('admin.materiais.adicionar');
            Route::post('/salvar', [MateriaisController::class, 'salvar'])->name('admin.materiais.salvar');
            Route::get('/editar/{id}', [MateriaisController::class, 'editar'])->name('admin.materiais.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [MateriaisController::class, 'atualizar'])->name('admin.materiais.atualizar');
            Route::get('/excluir/{id}', [MateriaisController::class, 'excluir'])->name('admin.materiais.excluir');
            
           
        });

        Route::prefix('pagamentos')->group(function() {
            Route::get('/adicionar', [PagamentoController::class, 'adicionar'])->name('admin.pagamentos.adicionar');
            Route::post('/salvar', [PagamentoController::class, 'salvar'])->name('admin.pagamentos.salvar');
            Route::get('/editar/{id}', [PagamentoController::class, 'editar'])->name('admin.pagamentos.editar');
            Route::match(['get', 'post'], '/atualizar/{id}', [PagamentoController::class, 'atualizar'])->name('admin.pagamentos.atualizar');
            Route::get('/excluir/{id}', [PagamentoController::class, 'excluir'])->name('admin.pagamentos.excluir');            
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

    Route::get('/repertorios', [RepertoriosController::class, 'index'])->name('repertorios');
   
    // Rota para buscar repertórios (pesquisa)
    Route::get('/repertorios/pesquisar', [RepertoriosController::class, 'search'])->name('admin.repertorios.search');
    Route::get('/repertorios/filtrar', [RepertoriosController::class, 'filtrar'])->name('admin.repertorios.filtrar');

    // Other Routes
   
    // Rota para buscar repertórios (pesquisa)

    
    // Redacoes Pendentes Routes
Route::get('/view/{is}', [RedacoesPendentesController::class, 'view']);
Route::post('/uploadproduct', [RedacoesPendentesController::class, 'store']);
Route::post('/save-edited-image/{id}', [RedacoesPendentesController::class, 'atualizar']);
Route::match(['get', 'post'], '/admin/correcao/atualizar/{id}', [RedacoesPendentesController::class, 'atualizar']);

    Route::get('/public/assets/materiais/{imageName}', 'App\Http\Controllers\MateriaisController@show')->name('pdf.show');
    Route::get('/public/assets/textosApoio/{imageName}', 'App\Http\Controllers\TemaController@show')->name('pdf.mostrar');
});

?>
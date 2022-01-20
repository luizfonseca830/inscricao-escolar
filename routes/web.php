<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelasDinamicas\TelasEditalController;
use App\Http\Controllers\TelasDinamicas\TelaLiberarController;
use App\Http\Controllers\TelasDinamicas\TelaCriarController;
use App\Models\Cargo;
use App\Models\Escolaridade;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//LOGIN
Auth::routes([
    'register' => false
]);
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sair', function () {
    auth()->logout();
    return redirect()->route('inical');
})->name('sair');

Route::get('/', [\App\Http\Controllers\WeelcomeController::class, 'index'])->name('inical');

Route::get('/solicitacao/recurso', [\App\Http\Controllers\RecursoController::class, 'index'])->name('recurso');

Route::post('/recurso-pedir', 'RecursoController@pedirRecurso')->name('recurso-pedir');

Route::get('/registro/{id}', [\App\Http\Controllers\RegistroController::class, 'index'])->name('registro');
Route::any('registro/parte1', [\App\Http\Controllers\RegistroController::class, 'storePart1'])->name('registro/parte1');
Route::post('registro/parte2', 'RegistroController@storePart2')->name('registro/parte2');
Route::get('/registro/anexos/{id}', [\App\Http\Controllers\RegistroController::class, 'buscaIndex'])->name('registro/anexos');

Route::get('/comprovante/{comprovante}', 'ComprovanteController@index')->name('registro/comprovante'); //

Route::get('/protocolo', 'ComprovanteController@protocolo')->name('protocolo');
Route::post('comprovante-procurar', 'ComprovanteController@procurar')->name('comprovante-procurar');

Route::group(['middleware' => 'auth'], function () {
    Route::get('table-list', function () {
        return view('pages.table_list');
    })->name('table');

    Route::get('/visualizacao/{editalID}', 'AreaRestritaController@index')->name('/visualizacao');
    Route::get('/avaliar/{id}', [\App\Http\Controllers\AreaRestritaController::class, 'index2'])->name('/avaliar');
    Route::post('pontuacao', 'PontuacaoController@store')->name('pontuacao');

    Route::get('/revisao/{editalID}', 'AreaRestritaController@index3')->name('revisao');
    Route::get('/aprovar/{id}', 'AreaRestritaController@aprovar')->name('/aprovar');
    Route::get('/aprovarpessoa/{id}', 'PontuacaoController@aceitarAvaliacao')->name('aprovarpessoa');

    Route::get('/recurso/escolher/edital', [\App\Http\Controllers\RecursoAdminController::class, 'index'])->name('recurso.escolher.edital');
    Route::get('/visualizacao-recurso/{id}', 'AreaRestritaController@index4')->name('visualizacao-recurso');
    Route::get('/recurso-unico/{id}', [\App\Http\Controllers\AreaRestritaController::class, 'recursoUnico'])->name('recurso-unico');


    Route::get('/add-user', function () {
        return view('auth.register');
    })->name('add-user');
    Route::post('add-create', 'AddUserController@store')->name('add-create');
    Route::get('delete-user/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('delete-user');
    Route::get('edit-user/{id}', 'UserController@show')->name('edit-user');
    Route::any('update-user/{id}', 'UserController@update')->name('update-user');
    Route::get('/lista-transparencia', 'TransparenciaController@index')->name('lista-transparencia');
    Route::get('/unico-transparencia/{id}', 'TransparenciaController@show')->name('unico-transparencia');
    Route::post('/pesquisa-transparencia', 'TransparenciaController@search')->name('pesquisa-transparencia');

    Route::get('/tela-criar', [TelaCriarController::class, 'index'])->name('tela-criar');
    Route::get('/tela-liberar', [TelaLiberarController::class, 'index'])->name('tela-liberar');
    Route::post('tela-criar-salvar', [TelasEditalController::class, 'store'])->name('tela-criar-salvar');
    Route::get('tela-deletar/{id}', [TelasEditalController::class, 'delete'])->name('tela-deletar');
    Route::get('tela-unica-mostra/{id}', [TelasEditalController::class, 'show'])->name('tela-unica-mostra');
    Route::match(['post', 'get'], 'tela-editar/{id}', [TelasEditalController::class, 'update'])->name('tela-editar');

    Route::get('avaliacao-pne', 'PNE\AvaliacaoPNEController@index')->name('avaliacao-pne');
    Route::get('avaliacao-pne-aceitar/{id}', 'PNE\AvaliacaoPNEController@update')->name('avaliacao-pne-aceitar');
    Route::get('avaliacao-pne-recusar-motivo/{id}', 'PNE\AvaliacaoPNERecusarController@show')->name('avaliacao-pne-recusar-motivo');
    Route::match(['post', 'get'], 'avaliacao-pne-recusar/{id}', 'PNE\AvaliacaoPNERecusarController@update')->name('avaliacao-pne-recusar');

    Route::get('visualizacao-avaliar/{id}', 'VisualizacaoPessoas\VisualizarAvaliacaoController@show')->name('visualizacao-avaliar');
    Route::get('busca-candidato', 'BuscaCandidatos\BuscaCandidatosController@index')->name('busca-candidatos');
    Route::post('pesquisa-candidato', 'BuscaCandidatos\BuscaCandidatosController@show')->name('pesquisa-candidato');

    Route::get('alterar-titulo-mostrar', 'TelasDinamicas\TituloController@index')->name('titulo.index');
    Route::post('alterar-titulo/{id}', 'TelasDinamicas\TituloController@update')->name('titulo.update');

    Route::get('lista-carrossel', 'TelasDinamicas\CarrosselController@index')->name('lista.carrossel.index');
    Route::get('carrossel-edit/{id}', [\App\Http\Controllers\TelasDinamicas\CarrosselController::class, 'edit'])->name('carrossel.edit');
    Route::post('carrossel-update/{id}', 'TelasDinamicas\CarrosselController@update')->name('carrossel.update');
    Route::get('carrossel-delete/{id}', 'TelasDinamicas\CarrosselController@destroy')->name('carrossel.delete');
    Route::get('carrossel-create', 'TelasDinamicas\CarrosselController@create')->name('carrossel.create');
    Route::post('carrossel-store', [\App\Http\Controllers\TelasDinamicas\CarrosselController::class, 'store'])->name('carrossel.store');

    Route::get('lista/formularios', [\App\Http\Controllers\ListaInscricoesController::class, 'index'])->name('lista.formularios');
    Route::get('formularios/visualizar/{id}', [\App\Http\Controllers\ListaInscricoesController::class, 'show'])->name('formulario.show');
    Route::get('remover/TipoAnexo/{id}', [\App\Http\Controllers\TipoAnexoController::class, 'destroy'])->name('tipoanexo.delete');
    Route::post('procurar/cargo', [\App\Http\Controllers\ListaInscricoesController::class, 'search'])->name('cargo.search');
    Route::post('salvar/tipoAnexo', [\App\Http\Controllers\TipoAnexoController::class, 'store'])->name('tipoanexo.store');

    //Configurações do edital
    Route::get('lista/escolaridade/{id}', [\App\Http\Controllers\EscolaridadeController::class, 'index'])->name('escolaridade.lista.index');
    Route::post('/escolaridade/salvar', [\App\Http\Controllers\EscolaridadeController::class, 'store'])->name('escolaridade.store');
    Route::get('/escolaridade/aceitar/{idEdital}/{idEscolaridade}', [\App\Http\Controllers\EscolaridadeEditalDinamicoController::class, 'aceito'])->name('escolaridade.edital.dinamico');
    Route::get('/escolaridade/remover/{idEdital}/{idEscolaridade}', [\App\Http\Controllers\EscolaridadeEditalDinamicoController::class, 'remover'])->name('escolaridade.edital.dinamico.remover');

    Route::get('/escolaridade/cargo/{idEdital}/{idEscolaridade}', [\App\Http\Controllers\EscolaridadeEditalDinamicoController::class, 'escolaridadeEditalCargo'])->name('escolaridade.edital.cargo');
    Route::post('/cargo/salvar', [\App\Http\Controllers\CargoController::class, 'store'])->name('cargo.store');
    Route::get('/cargo/deletar/{id}', [\App\Http\Controllers\CargoController::class, 'destroy'])->name('cargo.delete');
    Route::get('/cargo/editar', [\App\Http\Controllers\CargoController::class, 'edit'])->name('cargo.edita');
    Route::post('/cargo/update', [\App\Http\Controllers\CargoController::class, 'update'])->name('cargo.update');

    Route::get('pontuacao/{id}', [\App\Http\Controllers\EscolaridadeController::class, 'index'])->name('escolaridade.lista.index');

    Route::get('edital/formulario/anexos/{id}', [\App\Http\Controllers\EditalDinamicoTipoAnexoController::class, 'index'])->name('edital.formulario.anexo');
    Route::post('/edital/formulario/salvar', [\App\Http\Controllers\EditalDinamicoTipoAnexoController::class, 'store'])->name('edital.formulario.store');
    Route::get('/documento/dinamico/editar', [\App\Http\Controllers\EditalDinamicoTipoAnexoController::class, 'edit'])->name('edital.formulario.edita');
    Route::post('/documento/dinamico/update', [\App\Http\Controllers\EditalDinamicoTipoAnexoController::class, 'update'])->name('edital.formulario.update');

    Route::get('/documento/dinamico/deletar/{id}', [\App\Http\Controllers\DocumentoDinamicoController::class, 'destroy'])->name('documento.dinamico.delete');

    Route::post('/avaliador/aprovar/', [\App\Http\Controllers\AvaliadorAvaliarController::class, 'aprovar'])->name('avaliador.avaliar.aprovar');
    Route::post('/avaliador/reprovar/', [\App\Http\Controllers\AvaliadorAvaliarController::class, 'reprovar'])->name('avaliador.avaliar.reprovar');

    Route::get('/revisor/index/{id}', [\App\Http\Controllers\RevisorRevisarController::class, 'index'])->name('revisor.index');
    Route::post('/revisor/aceitar/avaliacao', [\App\Http\Controllers\RevisorRevisarController::class, 'aceitarAvaliar'])->name('revisor.aceitar.avaliacao');
    Route::post('/revisor/reavaliar/', [\App\Http\Controllers\RevisorRevisarController::class, 'reavaliar'])->name('revisor.reavaliar');

    Route::get('/escolher/edital/visualizacao', [\App\Http\Controllers\VisualizacaoTipoEdital::class, 'index'])->name('visualizacao.escolher.edital');
    Route::get('/escolher/edital/revisao', [\App\Http\Controllers\RevisaoTipoEdital::class, 'index'])->name('revisao.escolher.edital');

    Route::post('/recurso/recusar', [\App\Http\Controllers\RecursoAdminController::class, 'negar'])->name('recurso.negar');
    Route::post('/recurso/aceitar', [\App\Http\Controllers\RecursoAdminController::class, 'aceitar'])->name('recurso.aceitar');

    Route::get('/relatorio/selecionar/edital', [\App\Http\Controllers\RelatoriosController::class, 'selecionarEdital'])->name('relatorio.selecionar.edital');
    Route::get('/relatorio/visualizar/{id}', [\App\Http\Controllers\RelatoriosController::class, 'index'])->name('relatorio.visualizar');
    Route::post('/relatorio/gerar/', [\App\Http\Controllers\RelatoriosController::class, 'gerarRelatorio'])->name('relatorio.gerar');
    Route::get('/relatorio/unico/{id}', [\App\Http\Controllers\RelatoriosController::class, 'visualizar'])->name('relatorio.unico');
    Route::get('/controller/bloquear/{id}', [\App\Http\Controllers\UserController::class, 'block'])->name('user.block');

    //LISTA CANDIDATOS
    Route::get('lista/candidatos/{pessoas?}', [\App\Http\Controllers\ListaCandidatos\ListaController::class, 'index'])->name('lista.candidatos.index');
    Route::post('lista/candidatos/filtro', [\App\Http\Controllers\ListaCandidatos\ListaController::class, 'filtro'])->name('lista.candidatos.filtro');
    Route::get('candidato/{id}', [\App\Http\Controllers\ListaCandidatos\ListaController::class, 'devolverAvaliacao'])->name('lista.candidatos.devolverAvaliacao');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::get('/gerarPDF/{comprovante}', 'ComprovanteController@gerarComprovanteCpf')->name('gerarpdf-comprovante');
Route::get('pdf', function () {
    return view('pdf');
})->name('pdf');

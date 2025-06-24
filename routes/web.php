<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\BoletoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ProcessoSeletivoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return to_route('dashboard');
});

Route::get('/inscricao', [InscricaoController::class, 'index'])->name('inscricao.index');
Route::post('/inscricao', [InscricaoController::class, 'store'])->name('inscricao.store');
Route::get('/inscricao/comprovante/{id}', [InscricaoController::class, 'comprovante'])->name('inscricao.comprovante');
Route::get('/boleto/{id}', [BoletoController::class, 'gerar'])->name('boleto.gerar');
Route::get('/boleto/mostrar/{id}', [BoletoController::class, 'mostrarBoleto'])->name('boleto.mostrar');

Route::get('/inscricao/comprovante/{id}/download', [InscricaoController::class, 'downloadComprovante'])->name('inscricao.downloadComprovante');

Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index'); // Tela de listagem
Route::get('/alunos/{id}/edit', [AlunoController::class, 'edit'])->name('alunos.edit'); // Tela de edição
Route::put('/alunos/{id}', [AlunoController::class, 'update'])->name('alunos.update');
Route::get('/boleto/reimprimir/{paymentId}', [AlunoController::class, 'reimprimirBoleto'])->name('boleto.reimprimir'); // Reimprimir boleto // Atualizar aluno




//Rota para a tela  de incrição
//Route::get('/inscricao/{processo}', [InscricaoController::class, 'show'])->name('inscricao.show');

//Rota para a tela de processo seletivo
//Route::post('/inscricao/{processo}/submit', [InscricaoController::class, 'submit'])->name('inscricao.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/ofertas', [OfertaController::class, 'index'])->name('ofertas.index');
Route::post('/ofertas', [OfertaController::class, 'store'])->name('ofertas.store');
Route::get('/ofertas/{oferta}/edit', [OfertaController::class, 'edit'])->name('ofertas.edit');
Route::put('/ofertas/{oferta}', [OfertaController::class, 'update'])->name('ofertas.update');
Route::delete('/ofertas/{oferta}', [OfertaController::class, 'destroy'])->name('ofertas.destroy');
Route::post('/ofertas/{oferta}/duplicate', [OfertaController::class, 'duplicate'])->name('ofertas.duplicate');
Route::resource('cursos', CursoController::class);

Route::middleware('auth')->group(function () {
    Route::resource('/processos', ProcessoSeletivoController::class);
    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

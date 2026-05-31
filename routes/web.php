<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicosController;

Route::get('/', function () {
    return redirect()->route('medicos.index');
});

Route::get('/medicos', [MedicosController::class, 'index'])
    ->name('medicos.index');
Route::get('/medicos/create', [MedicosController::class, 'create'])
    ->name('medicos.create');    

Route::get('/medicos/{id}', [MedicosController::class, 'show'])
    ->name('medicos.show');
Route::post('/medicos', [MedicosController::class, 'store'])->name('medicos.store');

Route::delete('/medicos/{id}', [MedicosController::class, 'destroy'])->name('medicos.destroy');

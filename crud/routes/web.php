<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

// Route::get('/example-uri',[Controller::class, 'function'])->name('example'); // estructura de una ruta convencional
Route::get('/note/{id}',[NoteController::class, 'index'])->name('note.index'); // parametro dinamico obligatorio
// Route::get('/note/{id?}',[NoteController::class, 'index'])->name('note.index'); // parametro dinamico opcional

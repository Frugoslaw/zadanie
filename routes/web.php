<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index'])->name('index');
Route::get('/pets', [PetController::class, 'create'])->name('addPet');
Route::post('/pets', [PetController::class, 'store'])->name('storePet');
Route::get('/pets/{id}', [PetController::class, 'show'])->name('showPet');
Route::post('/pets/search', [PetController::class, 'searchByStatus'])->name('searchPetsByStatus');
Route::post('/pets/searchID', [PetController::class, 'searchPetById'])->name('searchPetById');

Route::get('/pet/edit/{id}', [PetController::class, 'edit'])->name('editPet');

Route::put('/pet/update', [PetController::class, 'update'])->name('updatePet');
Route::delete('/pets/{id}', [PetController::class, 'destroy'])->name('deletePet');

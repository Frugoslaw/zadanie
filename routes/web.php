<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index'])->name('index');

Route::prefix('pets')->group(function () {
    Route::get('/', [PetController::class, 'create'])->name('addPet');
    Route::post('/', [PetController::class, 'store'])->name('storePet');
    Route::get('/{id}', [PetController::class, 'show'])->name('showPet');
    Route::get('/edit/{id}', [PetController::class, 'edit'])->name('editPet');
    Route::put('/update', [PetController::class, 'update'])->name('updatePet');
    Route::delete('/{id}', [PetController::class, 'destroy'])->name('deletePet');
});

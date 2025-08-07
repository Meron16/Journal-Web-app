<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\JournalWebController;

Route::middleware(['auth'])->group(function () {
    Route::get('/journals', [JournalWebController::class, 'index'])->name('journals.index');
    Route::get('/journals/create', [JournalWebController::class, 'create'])->name('journals.create');
    Route::post('/journals', [JournalWebController::class, 'store'])->name('journals.store');
    Route::get('/journals/{id}', [JournalWebController::class, 'show'])->name('journals.show');
    Route::get('/journals/{id}/edit', [JournalWebController::class, 'edit'])->name('journals.edit');
    Route::put('/journals/{id}', [JournalWebController::class, 'update'])->name('journals.update');
    Route::delete('/journals/{id}', [JournalWebController::class, 'destroy'])->name('journals.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// })-> name('home');


use App\Http\Controllers\ChatbotController;
Route::post('/chatbot-query', [ChatbotController::class, 'handleQuery']);



Route::get('/universities', function () {
    return view('universities');
})-> name('universities');

Route::get('/events', function () {
    return view('events');
})-> name('events');

Route::get('/financial', function () {
    return view('financial');
})-> name('financial');

Route::get('/career', function () {
    return view('career');
})-> name('career');

Route::get('/', function () {
    return view('dashboard');
})-> name('dashboard');

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

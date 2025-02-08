<?php
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChatbotController;
use App\Models\Faq;

Route::post('/BrighterUs/public/chatbot-query', [ChatbotController::class, 'handleQuery']);

Route::get('/universities', function () {
    return view('universities');
})-> name('universities');

Route::get('/events', function () {
    return view('events');
})-> name('events');

use App\Http\Controllers\FinancialController;

Route::get('/financial', [FinancialController::class, 'scrapeWebsite'])->name('financial');

Route::get('/career', function () {
    return view('career');
})-> name('career');

Route::get('/', function () {
    $faqs = Faq::all();
    return view('dashboard', compact('faqs'));
})-> name('dashboard');

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

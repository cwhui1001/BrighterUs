<?php
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\ChatbotController;
use App\Models\Faq;

Route::post('/BrighterUs/public/chatbot-query', [ChatbotController::class, 'handleQuery']);

// Route::get('/universities', function () {
//     return view('universities');
// })-> name('universities');

use App\Http\Controllers\CourseController;

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/filter', [CourseController::class, 'filter'])->name('courses.filter');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/compare', [CourseController::class, 'compare'])->name('courses.compare');




Route::get('/events', function () {
    return view('events');
})-> name('events');

Route::prefix('financial')->name('financial.')->group(function () {
    Route::get('/need-based', [FinancialController::class, 'needBased'])->name('need-based');
    Route::get('/external-sponsorship', [FinancialController::class, 'external'])->name('external');
    Route::get('/study-loan', [FinancialController::class, 'loan'])->name('loan');
    Route::get('/scholarship/{scholarship}', [FinancialController::class, 'show'])->name('scholarship.show');
});

Route::get('/career', function () {
    return view('career');
})-> name('career');

Route::get('/', function () {
    $faqs = Faq::all();
    return view('dashboard', compact('faqs'));
})-> name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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

use App\Http\Controllers\AdminEventController;

// Admin Routes
Route::get('/admin/events', [AdminEventController::class, 'index'])->name('admin.events');
Route::post('/admin/events/store', [AdminEventController::class, 'store'])->name('admin.events.store');
Route::put('/admin/events/{id}', [AdminEventController::class, 'update'])->name('admin.events.update');
Route::delete('/admin/events/delete/{id}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');


use App\Http\Controllers\EventController;
Route::get('/events', [EventController::class, 'index'])->name('events');

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

use App\Http\Controllers\NotificationController;

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);

use App\Http\Controllers\AdminController;

    Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/update-profile-photo', [AdminController::class, 'updateProfilePhoto'])
     ->name('admin.updateProfilePhoto');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    
    // Update user info
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');

    // Delete user
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.delete');

    // Add user
    Route::post('/admin/users/add', [AdminController::class, 'store'])->name('admin.users.add');
});

use App\Http\Controllers\AdminCourseController;

Route::get('/admin/courses', [AdminCourseController::class, 'index'])->name('admin.courses');
Route::post('/admin/courses', [AdminCourseController::class, 'store'])->name('admin.courses.store');
Route::put('/admin/courses/{id}', [AdminCourseController::class, 'update'])->name('admin.courses.update');



require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatbotController;
use App\Models\Faq;

Route::get('/', function () {
    $faqs = Faq::all();
    return view('dashboard', compact('faqs'));
})-> name('dashboard');

Route::post('chatbot-query', [ChatbotController::class, 'handleQuery']);



use App\Http\Controllers\NotificationController;
Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->middleware('auth');



use App\Http\Controllers\CourseController;

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/filter', [CourseController::class, 'filter'])->name('courses.filter');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/compare', [CourseController::class, 'compare'])->name('courses.compare');


use App\Http\Controllers\EventController;
Route::get('/events', [EventController::class, 'index'])->name('events');


use App\Http\Controllers\FinancialController;
Route::prefix('financial')->name('financial.')->group(function () {
    Route::get('/need-based', [FinancialController::class, 'needBased'])->name('need-based');
    Route::get('/external-sponsorship', [FinancialController::class, 'external'])->name('external');
    Route::get('/study-loan', [FinancialController::class, 'loan'])->name('loan');
    Route::get('/scholarship/{scholarship}', [FinancialController::class, 'show'])->name('scholarship.show');
});

Route::get('/career', function () {
    return view('career');
})-> name('career');


use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


use App\Http\Controllers\AdminController;

    Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/update-profile-photo', [AdminController::class, 'updateProfilePhoto'])->name('admin.updateProfilePhoto');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users'); 
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.delete');
    Route::post('/admin/users/add', [AdminController::class, 'store'])->name('admin.users.add');

});

use App\Http\Controllers\AdminCourseController;

Route::prefix('admin/courses')->name('admin.courses.')->middleware('auth')->group(function () {
    Route::get('/', [AdminCourseController::class, 'index'])->name('index'); // List all courses
    Route::get('/create', [AdminCourseController::class, 'create'])->name('create'); // Show create form
    Route::post('/', [AdminCourseController::class, 'store'])->name('store'); // Store new course
    Route::get('/{id}/edit', [AdminCourseController::class, 'edit'])->name('edit'); // Show edit form
    Route::put('/{id}', [AdminCourseController::class, 'update'])->name('update'); // Update course
    Route::delete('/{id}', [AdminCourseController::class, 'destroy'])->name('destroy'); // Delete course
});

use App\Http\Controllers\AdminEventController;

// Admin Routes
Route::get('/admin/events', [AdminEventController::class, 'index'])->name('admin.events');
Route::post('/admin/events/store', [AdminEventController::class, 'store'])->name('admin.events.store');
Route::put('/admin/events/update/{id}', [AdminEventController::class, 'update'])->name('admin.events.update');
Route::delete('/admin/events/delete/{id}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');

use App\Http\Controllers\AdminFinancialController;


Route::prefix('admin/financial')->name('admin.financial.')->middleware('auth')->group(function () {
    Route::get('/scholarships', [AdminFinancialController::class, 'index'])->name('scholarships');
    Route::get('/scholarships/create', [AdminFinancialController::class, 'create'])->name('scholarships.create');
    Route::post('/scholarships', [AdminFinancialController::class, 'store'])->name('scholarships.store');
    Route::get('/scholarships/{id}/edit', [AdminFinancialController::class, 'edit'])->name('scholarships.edit');
    Route::put('/scholarships/{id}', [AdminFinancialController::class, 'update'])->name('scholarships.update');
    Route::delete('/scholarships/{id}', [AdminFinancialController::class, 'destroy'])->name('scholarships.destroy');
});

require __DIR__.'/auth.php';

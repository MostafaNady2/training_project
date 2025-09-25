<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'candidate') {
        return redirect()->route('jobs.index');
    } elseif ($user->role === 'employer') {
        return redirect()->route('jobs.my-jobs');
    } elseif ($user->role === 'admin') {
        return redirect()->route('admin.all-jobs');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Job Board Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create')->middleware(['auth', 'role:employer']);
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store')->middleware(['auth', 'role:employer']);
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit')->middleware(['auth', 'role:employer']);
Route::patch('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update')->middleware(['auth', 'role:employer']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy')->middleware(['auth', 'role:employer']); // ✅ fixed here
Route::get('/my-jobs', [JobController::class, 'myJobs'])->name('jobs.my-jobs')->middleware(['auth', 'role:employer']);
Route::get('/applications/received', [ApplicationController::class, 'received'])->name('applications.received')->middleware(['auth', 'role:employer']);
Route::patch('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept')->middleware(['auth', 'role:employer']);
Route::patch('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject')->middleware(['auth', 'role:employer']);

// candidate Routes
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store')->middleware(['auth', 'role:candidate']);
Route::get('/applications/my-applications', [ApplicationController::class, 'myApplications'])->name('applications.my-applications')->middleware(['auth', 'role:candidate']);
Route::get('/applications/pending', [ApplicationController::class, 'pending'])->name('applications.pending')->middleware(['auth', 'role:candidate']);
Route::get('/applications/approved', [ApplicationController::class, 'approved'])->name('applications.approved')->middleware(['auth', 'role:candidate']);
Route::get('/applications/rejected', [ApplicationController::class, 'rejected'])->name('applications.rejected')->middleware(['auth', 'role:candidate']);
Route::delete('/applications/{application}', [ApplicationController::class, 'cancel'])->name('applications.cancel')->middleware(['auth', 'role:candidate']);
Route::get('/profile/history', [ProfileController::class, 'history'])->name('profile.history')->middleware(['auth', 'role:candidate']);

// admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/pending-jobs', [AdminController::class, 'pendingJobs'])->name('admin.pending-jobs');
    Route::get('/approved-jobs', [AdminController::class, 'approvedJobs'])->name('admin.approved-jobs');
    Route::get('/all-jobs', [AdminController::class, 'allJobs'])->name('admin.all-jobs');
    Route::get('/user-behavior', [AdminController::class, 'userBehavior'])->name('admin.user-behavior');
    Route::post('/jobs/{job}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::delete('/jobs/{job}/reject', [AdminController::class, 'reject'])->name('admin.reject');
});


require __DIR__.'/auth.php';
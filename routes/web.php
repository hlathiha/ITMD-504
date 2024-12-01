<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserDashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/schedule/create', function () {
    return view('schedule_form'); // This will show the HTML form for creating a schedule.
})->name('schedule.create.form');

Route::get('/schedule/form', [ScheduleController::class, 'showForm'])->name('schedule.form');
Route::post('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
Route::get('/schedule/success', function () {
    return view('schedule_success');
})->name('schedule.success');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/schedule/create', [ScheduleController::class, 'createForm'])->name('schedule.create');
Route::get('/schedule/form', [ScheduleController::class, 'showForm'])->name('schedule.form');
Route::post('/schedule/store', [ScheduleController::class, 'store'])->name('schedule.store');

Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user-dashboard');
Route::get('/schedule/success', function () {
    return view('schedule_success');
})->name('schedule.success');




require __DIR__.'/auth.php';

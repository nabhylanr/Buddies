<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('calendar');
});

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/settings', function () {
    return view('settings');
});

// Routes khusus untuk tasks (harus di atas resource route)
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::get('/tasks/history', [TaskController::class, 'history'])->name('tasks.history');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// Route actions untuk complete/uncomplete
Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::patch('/tasks/{task}/uncomplete', [TaskController::class, 'uncomplete'])->name('tasks.uncomplete');

// API route
Route::get('/api/tasks/available-time-slots', [TaskController::class, 'getAvailableTimeSlots']);

// Resource route untuk yang tersisa (show, edit, update, destroy)
Route::resource('tasks', TaskController::class)->except(['index', 'create', 'store']);
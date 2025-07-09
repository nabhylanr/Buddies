<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RecapController;

Route::get('/', function () {
    return view('calendar');
});

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events');

Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');

Route::get('/settings', function () {
    return view('settings');
});

Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::get('/tasks/history', [TaskController::class, 'history'])->name('tasks.history');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::patch('/tasks/{task}/uncomplete', [TaskController::class, 'uncomplete'])->name('tasks.uncomplete');

Route::get('/api/tasks/available-time-slots', [TaskController::class, 'getAvailableTimeSlots']);

Route::resource('tasks', TaskController::class)->except(['index', 'create', 'store']);

Route::get('/user/create', [TaskController::class, 'create'])->name('tasks.create');

Route::get('/recaps', [RecapController::class, 'index'])->name('recaps.index');
Route::get('/recaps/create', [RecapController::class, 'create'])->name('recaps.create');
Route::post('/recaps', [RecapController::class, 'store'])->name('recaps.store');
Route::get('/recaps/{recap}', [RecapController::class, 'show'])->name('recaps.show');
Route::get('/recaps/{recap}/edit', [RecapController::class, 'edit'])->name('recaps.edit');
Route::put('/recaps/{recap}', [RecapController::class, 'update'])->name('recaps.update');
Route::delete('/recaps/{recap}', [RecapController::class, 'destroy'])->name('recaps.destroy');
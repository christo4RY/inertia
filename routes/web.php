<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix'=>'topics','middleware'=>'auth'], function () {
    Route::get('/', [TopicController::class,'index'])->name('topics');
    Route::get('/create', [TopicController::class,'create'])->name('topic.create');
    Route::post('/create', [TopicController::class,'store'])->name('topic.store');
    Route::get('/edit/{topic}', [TopicController::class,'edit'])->name('topic.edit');
    Route::put('/edit/{topic}', [TopicController::class,'update'])->name('topic.update');
    Route::delete('/delete/{topic}', [TopicController::class,'destory'])->name('topic.delete');
});

require __DIR__.'/auth.php';

<?php


use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TaskController;
//use App\Http\Controllers\TaskDiscussionController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});


Route::resource('job', JobController::class)
    ->middleware(['auth']);

Route::resource('task', TaskController::class)
    ->middleware(['auth']);




Route::resource('comments', CommentsController::class)
    ->middleware(['auth']);



require __DIR__.'/auth.php';

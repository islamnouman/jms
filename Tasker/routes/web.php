<?php

use Illuminate\Support\Facades\Auth;
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



Auth::routes();








/*
 *
 *
 *
 * it is default controller rout with authentication inside the controller file with the name of middleware
 *
 *
 *
 */







   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');











Route::middleware('auth:web')->group(function () {

    /** Dashboard URLS Start */


    Route::resource('task', App\Http\Controllers\TaskController::class);

});




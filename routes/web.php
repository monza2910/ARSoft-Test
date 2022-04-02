<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::get('task/sort/{by}/{sort}', [TaskController::class, 'SortBy'])->name('task.sort');
Route::get('task/status/{status}', [TaskController::class, 'orderByStatus'])->name('task.count');
Route::resource('task', TaskController::class);
Route::put('task/status/{id}', [TaskController::class, 'updateStatus'])->name('task.status');

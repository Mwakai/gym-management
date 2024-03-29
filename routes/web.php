<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainersController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/members', [MembersController::class, 'index'])->name('members.index');

Route::get('/pages/join_us', [MembersController::class, 'join_us'])->name('join_us');

Route::post('/pages/admin/addMember', [MembersController::class, 'addMember'])->name('admin.memebers');
Route::post('/pages/admin/deleteMember', [MembersController::class, 'deleteMember'])->name('admin.deleteMembers');

//TRAINERS ROUTE
Route::get('/admin/trainers', [TrainersController::class, 'index'])->name('trainers.index');
Route::post('/pages/admin/addTrainer', [TrainersController::class, 'addTrainer'])->name('admin.trainers');
Route::post('/pages/admin/updateTrainer', [TrainersController::class, 'updateTrainer'])->name('admin.updateTrainers');
Route::post('/pages/admin/deleteTrainer', [TrainersController::class, 'deleteTrainer'])->name('admin.deleteTrainers');

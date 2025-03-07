<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


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
    return view('index'); // resources/views/index.blade.php を表示
});
Route::get('/register',[RegisterController::class,'create'])->name('register');
Route::post('/register',[RegisterController::class,'store']);
Route::get('/login',[AuthController::class,'showlogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});
Route::get('/admin/search',[AdminController::class,'search']);
Route::get('/admin/export',[AdminController::class,'export']);
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('contact/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::get('thanks', function () {
    return view('thanks');
});
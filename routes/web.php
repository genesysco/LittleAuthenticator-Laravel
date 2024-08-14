<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\forgetPasswordController;
use App\Http\Controllers\adminController;

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
    return view('index');
})->name('home');

Route::get('/register', [UserController::class , 'registerPage'])->name('registerPage');
Route::get('/checkEmail/{email}', [UserController::class, 'checkEmail']);
Route::get('/checkUserName/{userName}', [UserController::class, 'checkUserName']);

Route::post('/insert', [UserController::class , 'insertUser'])->name('insertUser');
Route::get('/login', [UserController::class , 'loginPage'])->name('loginPage');
Route::post('/userHome', [UserController::class , 'userHomePage'])->name('userHomePage');
Route::get('/loggedIn', [UserController::class , 'loggedIn'])->name('loggedIn');
Route::get('/logOut', [UserController::class , 'logOut'])->name('logOut');


Route::get('/forgetPage', [forgetPasswordController::class , 'forgetPage'])->name('forgetPage');
Route::post('/sendVerfication', [forgetPasswordController::class, 'sendVerfication'])->name('sendVerfication');
Route::get('/resetPassword/{token}', [forgetPasswordController::class, 'repairPassword'])->name('repairPassword');
Route::post('/changedPassword', [forgetPasswordController::class, 'changedPassword'])->name('changedPassword');


Route::get('/AdminPanel', [adminController::class, 'adminPanel'])->name('adminPanel');
Route::get('/promoter/{username}', [adminController::class, 'promoter'])->middleware('auth');
Route::get('/deposer/{username}', [adminController::class, 'deposer'])->middleware('auth');
Route::get('/deleteUser/{username}', [adminController::class, 'remover'])->middleware('auth');
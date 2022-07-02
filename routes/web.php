<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserUpdate;
use Illuminate\Http\Request;


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

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('/login');
});
Route::get('/', function(Request $req) {
    return view('home', ["title" => $req->path()]);
});
Route::view('/about', 'about', ['title' => 'About Us']);
Route::get('/register', function(Request $req) {
    if($req->path('/register') && $req->session()->has('user')) {
        return redirect('/');
    }
    return view('register');
});
Route::get('/login', function(Request $req) {
    if($req->path('/login') && $req->session()->has('user')) {
        return redirect('/');
    }
    return view('login');
});
Route::get('/searchDonor', [UserController::class, 'getUser']);
Route::get('/search', [UserController::class, 'search']);
Route::post('/add-user', [UserController::class, 'addUser']);
Route::post('/login-user', [UserController::class, 'login']);
Route::get('/profile', [UserController::class, 'profile']);
Route::get('/update-user', [UserUpdate::class, 'user']);
Route::post('/update-user', [UserUpdate::class, 'updateUser']);
Route::get('/makeAdmin/{id}', [UserUpdate::class, 'admin']);
Route::get('/removeAdmin/{id}', [UserUpdate::class, 'removeAdmin']);
Route::get('/deleteUser/{id}', [UserUpdate::class, 'deleteUser']);
Route::post('/changeByAdmin', [UserUpdate::class, 'changeByAdmin']);

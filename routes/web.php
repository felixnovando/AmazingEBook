<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

//Created By 2301859543 – Felix Novando – LD01


Route::group(['middleware' => ['admin']], function(){
    Route::get('/updateRole/{id}', [UserController::class, 'getUpdateRolePage']);

    Route::patch('/updateRole', [UserController::class, 'updateRole']);

    Route::delete('/delete-user', [UserController::class, 'deleteUser']);

    Route::get('/account-maintenance', [UserController::class, 'getAccountMaintenancePage']);
});

Route::group(['middleware' => ['nonguest']], function(){
    Route::get('/detail/{id}', [EBookController::class, 'detail']);

    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/history-order', [OrderController::class, 'displayOrderHistory']);

    Route::post('/order', [OrderController::class, 'order']);

    Route::delete('delete-cart', [CartController::class, 'deleteCart']);

    Route::get('/cart', [CartController::class, 'getCartPage']);

    Route::post('/addCart', [CartController::class, 'addCart']);

    Route::get('/profile', [UserController::class, 'getUpdateProfilePage']);

    Route::get('/home', [EBookController::class, 'home']);

    Route::put('/updateProfile', [UserController::class, 'updateProfile']);
});

Route::group(['middleware' => ['guest']], function(){
    Route::post('/signup', [UserController::class, 'signup']);

    Route::post('/login', [UserController::class, 'login']);

    Route::get('/login',  [UserController::class, 'getLoginPage']);

    Route::get('/signup', [UserController::class, 'getSignUpPage']);

    Route::get('/', [UserController::class, 'index']);
});

//
Route::get('/switchLang/{locale}', [UserController::class, 'switchLang']);

Route::get('/successPage', function (){
    UserController::setLang();
    $message = Session::get("message");
    return view("pages.SuccessPage", compact('message'));
});





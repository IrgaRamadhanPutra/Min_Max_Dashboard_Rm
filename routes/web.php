<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AndonChuterFgController;

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



// Route::get('home', function () {
//     return view('welcome');
// });
// Auth::routes();

// Semua route bisa diakses tanpa middleware auth
Route::get('/', 'AndonChuterRmController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/api/stock-limit-data', [HomeController::class, 'fetchStockLimitData'])->name('fetchStockLimitData');

Route::get('/get_data_cust', 'AndonChuterRmController@get_data_cust')->name('get_data_cust');
Route::get('/andon_chuterfg', 'AndonChuterFgController@index')->name('andon_chuterfg');
Route::get('/get_kritis', 'AndonChuterFgController@getDatakritis')->name('getDatakritis');
Route::get('/get_over', 'AndonChuterFgController@getaDataover')->name('getaDataover');

// Route::get('reload_data_status', 'AndonChuterFgController@getDatastatus')->name('getDatastatus');

// Tampilkan form login kustom
Route::get('/login', 'CustomLoginController@showLoginForm');

// Proses login kustom
Route::post('/login', 'CustomLoginController@login')->name('login');

// Logout kustom
Route::post('/logout', 'CustomLoginController@logout')->name('logout');

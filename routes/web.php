<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api/mobile')->group(function () {
    
    Route::post('login', 'Api\HomeController@login');

     //sign up
    Route::post('sign_up', 'Api\HomeController@sign_up');

    Route::post('credit', 'Api\HomeController@credit');
    Route::post('debit', 'Api\HomeController@debit');
    //get customers
    Route::get('getcustomers', 'Api\RecordController@getcustomers');

    //get dealers
    Route::get('getdealers', 'Api\RecordController@getdealers');

    Route::post('get_records', 'Api\RecordController@get_records');

    //debit and credit
    Route::post('debitandcredit', 'Api\CreditDebitController@debitandcredit');
    //debit
    Route::post('debited', 'Api\CreditDebitController@debited');
    
    //change password
    Route::post('changePasswords', 'Api\ChangePasswordController@changePasswords');

    //deleteitems
    Route::post('deleteItems', 'Api\DeleteItemControler@deleteItems');

    //today all report
    Route::post('onedayreport', 'Api\TodayReportController@onedayreport');
});

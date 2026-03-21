<?php

use Illuminate\Support\Facades\Route;

    // Route::get('/', function () {
    //     return view('welcome');
    // });

Route::get('/', function(){
    return redirect('/login');
});

Route::get('login', '\App\Http\Controllers\Front\Auth\LoginController@getLoginForm')->name('user.login');
Route::post('login', '\App\Http\Controllers\Front\Auth\LoginController@postLoginForm')->name('user.login.store');

Route::get('register', '\App\Http\Controllers\Front\Auth\LoginController@getRegisterForm')->name('user.register');
Route::post('register', '\App\Http\Controllers\Front\Auth\LoginController@postRegisterForm')->name('user.register.store');
Route::post('logout', '\App\Http\Controllers\Front\Auth\LoginController@postLogoutForm')->name('user.logout.post')->middleware('user');
Route::get('email/verify', '\App\Http\Controllers\Front\Auth\VerificationController@notice')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', '\App\Http\Controllers\Front\Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', '\App\Http\Controllers\Front\Auth\VerificationController@resend')->name('verification.resend');
Route::get('forgot-password', '\App\Http\Controllers\Front\Auth\ForgotPasswordController@getForgotPassword')->name('user.forgot-password');
Route::post('forgot-password', '\App\Http\Controllers\Front\Auth\ForgotPasswordController@postForgotPassword')->name('user.forgot-password.post');
Route::get('reset-password/{token}', '\App\Http\Controllers\Front\Auth\ForgotPasswordController@getResetPassword')->name('password.reset');
Route::post('reset-password', '\App\Http\Controllers\Front\Auth\ForgotPasswordController@postResetPassword')->name('user.reset-password.post');

Route::group(['middleware' => 'user'], function () {
    Route::get('companies', '\App\Http\Controllers\Admin\CompanyController@index')->name('companies.index');
    Route::get('companies/list', '\App\Http\Controllers\Admin\CompanyController@list')->name('companies.list');
    Route::get('companies/create', '\App\Http\Controllers\Admin\CompanyController@create')->name('companies.create');
    Route::post('companies/store', '\App\Http\Controllers\Admin\CompanyController@store')->name('companies.store');
    Route::get('companies/edit/{company}', '\App\Http\Controllers\Admin\CompanyController@edit')->name('companies.edit');
    Route::post('companies/update/{company}', '\App\Http\Controllers\Admin\CompanyController@update')->name('companies.update');
    Route::delete('companies/delete/{company}', '\App\Http\Controllers\Admin\CompanyController@delete')->name('companies.delete');
});
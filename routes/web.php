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
    Route::get('companies', '\App\Http\Controllers\Front\CompanyController@index')->name('companies.index');
    Route::get('companies/list', '\App\Http\Controllers\Front\CompanyController@list')->name('companies.list');
    Route::get('companies/create', '\App\Http\Controllers\Front\CompanyController@create')->name('companies.create');
    Route::post('companies/store', '\App\Http\Controllers\Front\CompanyController@store')->name('companies.store');
    Route::get('companies/edit/{id}', '\App\Http\Controllers\Front\CompanyController@edit')->name('companies.edit');
    Route::post('companies/update/{id}', '\App\Http\Controllers\Front\CompanyController@update')->name('companies.update');
    Route::delete('companies/delete/{id}', '\App\Http\Controllers\Front\CompanyController@destroy')->name('companies.delete');

    Route::get('payment-mode', '\App\Http\Controllers\Front\PaymentModeController@index')->name('payment-mode.index');
    Route::get('payment-mode/list', '\App\Http\Controllers\Front\PaymentModeController@list')->name('payment-mode.list');
    Route::get('payment-mode/create', '\App\Http\Controllers\Front\PaymentModeController@create')->name('payment-mode.create');
    Route::post('payment-mode/store', '\App\Http\Controllers\Front\PaymentModeController@store')->name('payment-mode.store');
    Route::get('payment-mode/edit/{id}', '\App\Http\Controllers\Front\PaymentModeController@edit')->name('payment-mode.edit');
    Route::post('payment-mode/update/{id}', '\App\Http\Controllers\Front\PaymentModeController@update')->name('payment-mode.update');
    Route::delete('payment-mode/delete/{id}', '\App\Http\Controllers\Front\PaymentModeController@destroy')->name('payment-mode.delete');

    Route::get('expense-category', '\App\Http\Controllers\Front\ExpenseCategoryController@index')->name('expense-category.index');
    Route::get('expense-category/list', '\App\Http\Controllers\Front\ExpenseCategoryController@list')->name('expense-category.list');
    Route::get('expense-category/create', '\App\Http\Controllers\Front\ExpenseCategoryController@create')->name('expense-category.create');
    Route::post('expense-category/store', '\App\Http\Controllers\Front\ExpenseCategoryController@store')->name('expense-category.store');
    Route::get('expense-category/edit/{id}', '\App\Http\Controllers\Front\ExpenseCategoryController@edit')->name('expense-category.edit');
    Route::post('expense-category/update/{id}', '\App\Http\Controllers\Front\ExpenseCategoryController@update')->name('expense-category.update');
    Route::delete('expense-category/delete/{id}', '\App\Http\Controllers\Front\ExpenseCategoryController@destroy')->name('expense-category.delete');

    Route::get('product', '\App\Http\Controllers\Front\ProductController@index')->name('product.index');
    Route::get('product/list', '\App\Http\Controllers\Front\ProductController@list')->name('product.list');
    Route::get('product/create', '\App\Http\Controllers\Front\ProductController@create')->name('product.create');
    Route::post('product/store', '\App\Http\Controllers\Front\ProductController@store')->name('product.store');
    Route::get('product/edit/{id}', '\App\Http\Controllers\Front\ProductController@edit')->name('product.edit');
    Route::post('product/update/{id}', '\App\Http\Controllers\Front\ProductController@update')->name('product.update');
    Route::delete('product/delete/{id}', '\App\Http\Controllers\Front\ProductController@destroy')->name('product.delete');
});
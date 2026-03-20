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

Route::middleware(['manager'])->group(function () {
    // manager dashboard
    Route::get('dashboard',function() {
        return view('front.manager.home.index');
    })->name('manager.dashboard');

    Route::group(['prefix' => 'member'], function () {
        Route::get('/', '\App\Http\Controllers\Front\MemberController@index')->name('manager.member');
        Route::get('/list', '\App\Http\Controllers\Front\MemberController@list')->name('member.list');
        Route::get('/create', '\App\Http\Controllers\Front\MemberController@create')->name('member.create');
        Route::post('/store', '\App\Http\Controllers\Front\MemberController@store')->name('member.store');
        Route::get('/edit/{memberId}', '\App\Http\Controllers\Front\MemberController@edit')->name('member.edit');
        Route::post('/update/{memberId}', '\App\Http\Controllers\Front\MemberController@update')->name('member.update');
        Route::delete('/delete/{memberId}', '\App\Http\Controllers\Front\MemberController@delete')->name('member.delete');
    });
});


Route::group(['prefix' => '/admin'], function () {

    Route::get('login', '\App\Http\Controllers\Admin\Auth\LoginController@getLoginForm')->name('admin.login');
    Route::post('login', '\App\Http\Controllers\Admin\Auth\LoginController@postLoginForm')->name('admin.login.post');

    Route::post('logout', '\App\Http\Controllers\Admin\Auth\LoginController@postLogoutForm')->name('admin.logout.post')->middleware('admin');

    Route::get('home', '\App\Http\Controllers\Admin\HomeController@index')->name('admin.home')->middleware('admin');

    // start user route
    Route::group(['middleware' => 'admin', 'prefix' => 'user'], function () {
        Route::get('/', '\App\Http\Controllers\Admin\UserController@index')->name('admin.user');
        Route::get('/list', '\App\Http\Controllers\Admin\UserController@list')->name('user.list');
        Route::get('/create', '\App\Http\Controllers\Admin\UserController@create')->name('user.create');
        Route::post('/store', '\App\Http\Controllers\Admin\UserController@store')->name('user.store');
        Route::get('/edit/{user}', '\App\Http\Controllers\Admin\UserController@edit')->name('user.edit');
        Route::post('/update/{user}', '\App\Http\Controllers\Admin\UserController@update')->name('user.update');
        Route::delete('/delete/{user}', '\App\Http\Controllers\Admin\UserController@delete')->name('user.delete');
    });
    // end user route

    // start user route
    Route::group(['middleware' => 'admin', 'prefix' => 'package'], function () {
        Route::get('/', '\App\Http\Controllers\Admin\PackageController@index')->name('admin.package');
        Route::get('/list', '\App\Http\Controllers\Admin\PackageController@list')->name('package.list');
        Route::get('/create', '\App\Http\Controllers\Admin\PackageController@create')->name('package.create');
        Route::post('/store', '\App\Http\Controllers\Admin\PackageController@store')->name('package.store');
        Route::get('/edit/{package}', '\App\Http\Controllers\Admin\PackageController@edit')->name('package.edit');
        Route::post('/update/{package}', '\App\Http\Controllers\Admin\PackageController@update')->name('package.update');
        Route::delete('/delete/{package}', '\App\Http\Controllers\Admin\PackageController@delete')->name('package.delete');
    });
    // end user route
});
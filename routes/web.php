<?php

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

Route::get('/', function(){
    return view('welcome');
})->name('inicio');

Route::get('/home', 'HomeController@index')->name('home');

    // Authentication Routes...
    Route::get('login', function(){
        return redirect('/');
    })->name('login');
    
    Route::post('login', 'Auth\LoginController@login')->middleware('guest');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    //Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    //Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');


    //Profile routes
    Route::get('perfil/{id}' , 'UserController@index')->name('ProfileUser')->where('id','[0-9]+');
    Route::get('perfil/{id}/edit', 'UserController@edit')->name('ProfileEdit')->where('id','[0-9]+')->middleware('CheckUser','web');
    Route::post('perfil/{id}/update', 'UserController@update')->name('ProfileUpdate')->where('id','[0-9]+')->middleware('CheckUser','web');
    Route::post('perfil/{id}/deleteProfileImage', 'UserController@deleteImage')->name('ProfileDeleteImage')->where('id','[0-9]+')->middleware('CheckUser');
    
    Route::post('perfil/{id}/updateAdmon', 'UserController@updateAdmon')->name('ProfileAdmon')->where('id','[0-9]+')->middleware('CheckUser','web');
    
    //Scholarships
    Route::group(['middleware'=>['web','CheckRole:Administrador']], function(){
       Route::get('becas', 'ScholarshipController@index')->name('Scholarships');
       Route::post('becas', 'ScholarshipController@store')->name('ScholarshipStore');
       Route::get('becas/{id}', 'ScholarshipController@show')->where('id','[0-9]+')->name('ScholarshipShow');
       Route::get('becas/{id}/edit', 'ScholarshipController@edit')->where('id','[0-9]+')->name('ScholarshipEdit');
       Route::get('becas/create', 'ScholarshipController@create')->name('ScholarshipCreate');
       Route::post('becas/{id}/update', 'ScholarshipController@update')->where('id','[0-9]+')->name('ScholarshipUpdate');
       Route::post('becas/softdelete', 'ScholarshipController@destroy')->name('ScholarshipSoftdelete');
    });

    //User control
    Route::group(['middleware'=>['web']], function(){
        Route::get('usuarios', 'UsersController@index')->name('users');
    });

    //Roles control
    Route::group(['middleware'=>['web','CheckRole:Administrador']], function(){
        Route::get('roles', 'RoleController@index')->name('Roles');
        Route::get('roles/create','RoleController@create')->name('RoleCreate');
        Route::post('roles', 'RoleController@store')->name('RoleStore');
        Route::post('roles/delete', 'RoleController@destroy')->name('RoleDelete');
        Route::get('roles/{id}/edit', 'RoleController@edit')->where('id','[0-9]+')->name('RoleEdit');
        Route::post('roles/{id}/update', 'RoleController@update')->where('id','[0-9]+')->name('RoleUpdate');
    });
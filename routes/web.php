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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('', ['uses' => 'Home@index']);
Route::get('/home', ['uses' => 'Home@index']);

Route::get('/login', ['uses' => 'Auth\Login@index']);
Route::post('/login', ['uses' => 'Auth\Login@index']);

Route::get('/logout', ['uses' => 'Auth\Login@logout']);

Route::get('/register', ['uses' => 'Auth\Register@student']);
Route::get('/register/student', ['uses' => 'Auth\Register@student']);
Route::post('/register/student', ['uses' => 'Auth\Register@student']);
Route::get('/register/company', ['uses' => 'Auth\Register@company']);
Route::post('/register/company', ['uses' => 'Auth\Register@company']);

Route::get('/reset_assword', ['uses' => 'Auth\Login@index']); //incomplete
Route::get('/forgot_password', ['uses' => 'Auth\Login@index']); // incomplete

Route::get('/hire', ['uses' => 'InternshipHome@hire']);
Route::get('/hire/save', ['uses' => 'InternshipHome@hire_save']);
Route::post('/hire/save', ['uses' => 'InternshipHome@hire_save']);
Route::get('/hire/save/{id}', ['uses' => 'InternshipHome@hire_edit']);
Route::post('/hire/save/{id}', ['uses' => 'InternshipHome@hire_edit']);

Route::get('/internship', ['uses' => 'InternshipHome@index']);
Route::get('/internship/{id}', ['uses' => 'InternshipHome@view']);
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/patient-status', function(){
    return response()->json(['name' => 'Abigail', 'state' => 'CA']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/manage-patient', 'ManagePatientController@index')->name('home');
Route::get('/manage-patient/add', 'ManagePatientController@add')->name('home');

/*
    API's
*/

Route::get('/get-patient/{crno}/{device_id}', 'ManagePatientController@patientData');

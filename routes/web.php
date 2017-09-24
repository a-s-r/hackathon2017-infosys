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
    return view('auth.login');
});


Route::get('/logout', function(){
	Auth::logout();
	return redirect('/');
});

Auth::routes();

Route::get('/home', 'ManagePatientController@index')->name('home');
Route::get('/test', 'HomeController@myTest')->name('home');

Route::get('/manage-patient', 'ManagePatientController@index')->name('home');
Route::get('/manage-patient/add', 'ManagePatientController@add')->name('home');
Route::get('/manage-patient/get-doctors/{id}', 'ManagePatientController@getDoctorsByDepartment')->name('home');
Route::post('/manage-patient/save', 'ManagePatientController@save');
Route::get('/manage-patient/edit/{id}', 'ManagePatientController@edit');
Route::post('/manage-patient/update', 'ManagePatientController@update');
Route::get('/manage-patient/delete/{id}', 'ManagePatientController@delete');
Route::get('/manage-patient/fcm', 'ManagePatientController@fcm');

// Routing for the Manage Halls
Route::get('/manage-hall','ManageHallController@index');
Route::get('/manage-hall/add','ManageHallController@add');
Route::post('/manage-hall/save','ManageHallController@save');
Route::get('/manage-hall/edit/{id}','ManageHallController@edit');
Route::post('/manage-hall/update/','ManageHallController@update');
Route::get('/manage-hall/delete/{id}','ManageHallController@deleteHall');

/*
    API's
*/

Route::get('/get-patient/{crno}/{device_id}', 'ManagePatientController@patientData');
Route::get('/is-doctor-valid/{doctor_phone}', 'ManagePatientController@isDoctorValid');
Route::get('/token-status/{doctor_phone}', 'ManagePatientController@tokenStatus');

/*
    End API's
*/
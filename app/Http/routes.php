<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['auth','admin']], function () {

  Route::resource('users', 'UserController');

});




Route::group(['middleware' => 'auth'], function () {

  Route::resource('professors', 'ProfessorController');
  Route::resource('courses', 'CourseController');
  Route::resource('areas','AreaController');
  Route::get('/', ['uses' =>'ScheduleController@index']);


});


Route::get('/dashboard', ['uses' =>'ScheduleController@index']);

Route::get('/schedules/create/{area}', ['uses' =>'ScheduleController@create']);
Route::delete('schedules/delete/{id}/{area}/{professor}',array('uses' => 'ScheduleController@destroy', 'as' => 'destroyroute'));


Route::get('schedules/{date}/{area}/{professor}', ['uses' =>'ScheduleController@show']);
Route::post('schedules', ['uses' =>'ScheduleController@store']);

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register',['as' => 'auth.register', 'uses' =>'Auth\AuthController@postRegister' ]);


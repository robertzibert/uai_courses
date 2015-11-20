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

Route::get('/test', function(){
  $areas = [
              ['name' => 'TI', 'complete_name' => 'Informática'],
              ['name' => 'TALLER', 'complete_name' => 'Taller'],
              ['name' => 'OPERACIONES', 'complete_name' => 'Operaciones'],
              ['name' => 'OOCC', 'complete_name' => 'Oocc'],
              ['name' => 'MIN', 'complete_name' => 'Minería'],
              ['name' => 'MAT', 'complete_name' => 'Matemática'],
              ['name' => 'LAB', 'complete_name' => 'Laboratorio'],
              ['name' => 'ING', 'complete_name' => 'Ingeniería'],
              ['name' => 'FIS', 'complete_name' => 'Física'],
              ['name' => 'EYM', 'complete_name' => 'Eym'],
              ['name' => 'EST', 'complete_name' => 'Estadística'],
              ['name' => 'BIO', 'complete_name' => 'Bioingeniería'],
              ['name' => '5TO AÑO', 'complete_name' => 'Quinto Año'],
            ];
return $areas;
});

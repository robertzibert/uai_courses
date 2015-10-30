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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('professors', 'ProfessorController');
Route::resource('courses', 'CourseController');
Route::resource('tweets', 'TweetController');
Route::get('schedules/show/{area}/{professor}', ['uses' =>'ScheduleController@show']);
Route::get('schedules/create/{area}/{professor}', ['uses' =>'ScheduleController@create']);
Route::post('schedules', ['uses' =>'ScheduleController@store']);
//Route::resource('schedules', 'ScheduleController');
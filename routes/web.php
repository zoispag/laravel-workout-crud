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

Route::resource('trainees', 'TraineesController');
/* Assign a plan to a trainee route */
Route::name('trainees.assign')->get('trainees/assign/{trainee}/{plan}', 'TraineesController@assign');
Route::name('trainees.unassign')->get('trainees/unassign/{trainee}', 'TraineesController@unassign');
Route::resource('plans', 'PlansController');
Route::resource('days', 'DaysController', ['except' => [
    'create', 'edit'
]]);
/* days.create & days.edit routes with plan as a parameter */
Route::name('days.create')->get('/days/create/{plan}', 'DaysController@create');
Route::name('days.edit')->get('/days/{day}/edit/{plan}', 'DaysController@edit');
Route::resource('exercises', 'ExercisesController', ['except' => [
    'create', 'edit'
]]);
/* exercises.create & exercises.edit routes with day as a parameter */
Route::name('exercises.create')->get('/exercises/create/{day}', 'ExercisesController@create');
Route::name('exercises.edit')->get('/exercises/{exercise}/edit/{day}', 'ExercisesController@edit');

//Group For API Routes with prefix /api/v1
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::resource('trainees', 'TraineesAPIController', [
        'as' => 'api'
    ]);
    Route::resource('days', 'DaysAPIController', [
        'as' => 'api'
    ]);
    Route::resource('exercises', 'ExercisesAPIController', [
        'as' => 'api'
    ]);
    Route::resource('plans', 'PlansAPIController', [
        'as' => 'api'
    ]);
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'user'], function () {
    Route::post('auth','UserController@index');
    Route::post('create','UserController@store');
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'task'], function () {
        Route::get('list','TaskController@index');
        Route::post('add','TaskController@store');
        Route::post('update','TaskController@update');
        Route::get('view','TaskController@show');
        Route::get('edit','TaskController@edit');
    });
    Route::prefix('review_checklist')->group(function () {
        Route::get('list', 'EmpReviewChecklistsController@index');
        Route::post('add', 'EmpReviewChecklistsController@store');
        Route::post('update', 'EmpReviewChecklistsController@store');
        Route::post('delete', 'EmpReviewChecklistsController@destroy');
    });
    Route::group(['prefix' => 'picklist'], function () {
        Route::get('list','PicklistController@show');
        Route::get('edit/{id}','PicklistController@update');
        Route::get('task/{id}','PicklistController@show');
    });
    Route::group(['prefix' => 'openproject'], function () {
        Route::post('sync','OpenProjectAPIController@show');
    });
});

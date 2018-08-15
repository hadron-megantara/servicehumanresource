<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(array('prefix' => 'v1'), function(){
    Route::post('/login', 'Api\LoginController@login');

    Route::middleware(['auth:api'])->group(function () {
        Route::group(array('prefix' => 'master'), function(){
            Route::get('/province', 'MasterController@getProvince');
            Route::get('/district', 'MasterController@getDistrict');
            Route::get('/province', 'MasterController@getProvince');
        });

        Route::group(array('prefix' => 'config'), function(){
            Route::get('/menu', 'ConfigController@getMenu');
            Route::get('/permission', 'ConfigController@permission');
            Route::get('/roles', 'ConfigController@roles');
            Route::get('/users', 'ConfigController@users');
        });

        Route::group(array('prefix' => 'user'), function(){
            Route::get('profile', 'UserController@getProfile');
            Route::get('profile/photo', 'UserController@photoUpload');
        });

        Route::resource('/outlet', 'Api\OutletController');
        // Route::post('/outlet/{id}', 'Api\OutletController@upload');
    });

});

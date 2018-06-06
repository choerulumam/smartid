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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {
    Route::post('login', 'Api\v1\AuthController@login');
    Route::post('logout', 'Api\v1\AuthController@logout');
    Route::post('refresh', 'Api\v1\AuthController@refresh');
    Route::post('me', 'Api\v1\AuthController@me');
    Route::post('register', 'Api\v1\AuthController@register');
    Route::get('m', 'Api\v1\AuthController@getMahasiswa');
});

Route::group([
    // 'middleware' => 'api',
    'prefix' => 'schedule',
], function ($router) {
    Route::get('list', 'Api\v1\PresenceController@getJadwal');
});

Route::post('/portal/login', 'Admin\Api\AttendanceLoginController@get_login');
Route::get('/portal/login/getmac', 'Admin\Api\AttendanceLoginController@check_mac');

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
    return view('auth/login');
});
/*Route::prefix('api/v1')->group(function () {
    Route::get('users/{id}', '');
});*/
 Route::group(['prefix' => 'api/v1'], function () { 
    Route::get('users/fb_id/{id}',  'MemberControllerl@show');
    Route::get('users/{userid}/{birthday}/{gender}', 'MemberControllerl@create');
    Route::get('users/show', 'MemberControllerl@index');
 });
/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';

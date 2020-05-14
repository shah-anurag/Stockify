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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/data/{fname}', function(Request $request, $fname) {
    // $request->user($name);
    if (!($fp = fopen($fname, 'r'))) {
        die("Can't open file...");
    }

    $key = fgetcsv($fp,"1024",",");
    $json = array();
    $headers = array();

    while ($row = fgetcsv($fp,"1024",",")) {
        $json[] = array_combine($key, $row);
    }
    // release file handle
    fclose($fp);
    
    // encode array to json
    return json_encode(array('keys' => $key, 'data' => $json));

});

Route::group(['middleware' => 'web'], function () {
    Route::group(['prefix'=>'admin',  'middleware' => 'admin'], function(){
        Route::match(['put', 'patch'], '/buy','HomeController@update');
    });
});
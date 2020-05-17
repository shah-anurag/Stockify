<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facade as Debugbar;

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

Route::get('/stocks/{id}', function(Request $request, $id) {
    $data = DB::table('stock_purchases')
            ->where('u_id', '=', $id)
            // ->join('users', 'stock_purchases.u_id', '=', 'users.id')
            ->join('stocks', 'stock_purchases.s_id', '=', 'stocks.id')
            ->join('stock_purchase_prices', 'stock_purchases.s_id', '=', 'stock_purchase_prices.s_id')
            // ->groupBy('s_id')
            ->get(['stock_purchases.purchase_date', 'symbol', 'name', 'quantity', 'purchasing_price']);
    unset($data->id);
    unset($data->u_id);
    unset($data->s_id);
    Debugbar::info($data);
    return response($data);
})->middleware(['web']);

// Route::group(['middleware' => 'web'], function () {
    // Route::group(['prefix'=>'admin',  'middleware' => 'admin'], function(){
Route::match(['put', 'patch'], '/buy','HomeController@update');//->middleware('web');
    // });
// });
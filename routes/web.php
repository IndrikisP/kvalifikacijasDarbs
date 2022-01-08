<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

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
Route::get('/', 'App\Http\Controllers\PagesController@index');
Route::get('/about', 'App\Http\Controllers\PagesController@about');

Route::resource('tests', 'App\Http\Controllers\TestsController');

Route::get('/flags/guess', 'App\Http\Controllers\TestsController@flagsGuess');

Route::get('/flags/multiple', 'App\Http\Controllers\TestsController@flagsMultiple');

Route::get('/capitals/guess', 'App\Http\Controllers\TestsController@flagsGuess');

Route::post('/flags/update', 'App\Http\Controllers\TestsController@flagsUpdate');

Route::get('/capitals', 'App\Http\Controllers\TestsController@capitals');

Route::get('/countries', 'App\Http\Controllers\TestsController@countries');
//Route::get('/countries', function(){
    // $headers = [
    //     'X-CSCAPI-KEY' => 'WFQ5VnRZQ1NtM3FzcmxlRmlpY1RTbzFVdTNxbVE5ZkRTSzNHTWFNOA==',
    // ];
    // $client = new Client([
    //     'headers'=> $headers
    // ]
    // );
    // $r = $client->request('GET', 'https://api.countrystatecity.in/v1/countries');
    // $response = $r->getBody()->getContents();
    // $decoded_json = json_decode($response, false);
    // foreach($decoded_json as $resp){
    //     DB::table('countries')->updateOrInsert(
    //     ['name' => $resp->name],
    //     ['code' => $resp->iso2, 'capital' => 'temp']
    // );
    // }
    // //return $countries;
//});

<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
// Route::get('/B026', 'App\\Http\\Controllers\\B026_v1_20220916_Controller@index');
// Route::post('/B026','App\\Http\\Controllers\\B026_v1_20220916_Controller@output');
// Route::get('/B029', 'App\\Http\\Controllers\\B029_v1_20220920_Controller@index');
// Route::post('/B029','App\\Http\\Controllers\\B029_v1_20220920_Controller@test');
// Route::get('/B032','App\\Http\\Controllers\\B032_v2_20220929_Controller@index');
// Route::post('/B032','App\\Http\\Controllers\\B032_v2_20220929_Controller@test_output');
// Route::get('/B035','App\\Http\\Controllers\\B035_v1_20221012_Controller@index');
//Route::get('/B039','App\\Http\\Controllers\\paiza_b039Controller@index');
Route::get('/B023','App\\Http\\Controllers\\B023_Controller@index');
Route::post('/B023','App\\Http\\Controllers\\B023_Controller@output');
Route::get('/C099','App\\Http\\Controllers\\C099_v1_20221124_Controller@index');
Route::post('/C099','App\\Http\\Controllers\\C099_v1_20221124_Controller@output');
Route::get('/C113','App\\Http\\Controllers\\C113_Controller@index');
Route::post('/C113','App\\Http\\Controllers\\C113_Controller@output');
Route::get('/validate','App\\Http\\Controllers\\Validator_test@index_validate');
Route::post('/validate','App\\Http\\Controllers\\Validator_test@output_C042');
Route::get('/regular','App\\Http\\Controllers\\Regular_Controller@index_regular');
Route::post('/regular','App\\Http\\Controllers\\Regular_Controller@output_regular');

//Route::get('/phpinfo', function () {
//    phpinfo();
//});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

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



// Auth::routes();



// Route::group(['prefix' => '/api'], function () {
//     Route::get('/test', function () {
//         return response()->json([
//             "message" => "1",
//             "body" => [
//                 "id" => "1"
//             ]
//         ],200);
//     });    

//     Route::get('/',function () {
//         return response()->json([
//             "message" => "Don't Just poke me :)"
//         ],200);
//     });
// });

// Route::group(['prefix' => 'liff'], function () {
//     Route::get('/',function() {

//     });
// });

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');


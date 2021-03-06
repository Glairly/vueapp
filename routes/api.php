<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Models\Objects;
use App\Models\Conveyor;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
    Route::get('/user-list', [AuthController::class, 'userList']);    
    Route::post('/objects', function (Request $request) {
        $data = $request->all()["data"];
        Objects::create(['name' => "lemon", 'amount' => $data]);
        return response()->json($data);
    });
    Route::post('/conveyor', function (Request $request) {
        $data = $request->all()["data"];
        Conveyor::create(['status' => $data]);
        return response()->json($data);
    });
    Route::get('/time-series', function () {
        $data = App\Models\Objects::orderBy('id', 'desc')->take(7)->get();
        return response()->json($data);
    });
});


 
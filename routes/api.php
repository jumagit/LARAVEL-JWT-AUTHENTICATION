
<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientsModelController;

Route::post('auth/login', [AuthController::class, 'login'])->middleware(['cors']);

// Route::post('login', [AuthController::class,'login'])->middleware('api');
// Route::post('signup', [AuthController::class,'register'])->middleware('api');
// Route::group(['middleware'=>['auth:api']],function() {
//     Route::post('refresh', [AuthController::class,'refresh']);
//     Route::delete('logout', [AuthController::class,"destroy"]);
//     Route::get('me', [AuthController::class,"show"]);
// });

Route::group([

    'middleware' => ['auth:api', 'auth', 'cors'],
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth',   

], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh',  [AuthController::class, 'refresh']);
    Route::post('me',  [AuthController::class, 'me']);

//patient Routes

    Route::get('/patients', [PatientsModelController::class, 'index']);
    Route::post('/patients/store',[PatientsModelController::class, 'store']);
    Route::put('patients/{id}',[PatientsModelController::class, 'real']);
    Route::delete('patients/{id}', [PatientsModelController::class, 'deletePatient']);
    Route::get('patients/{id}', [PatientsModelController::class, 'show'] );

    //

});

// $response = $client->request('POST', '/api/user', [
//     'headers' => [
//         'Authorization' => 'Bearer '.$token,
//         'Accept' => 'application/json',
//         'Content-Type' => 'application/json',
//     ],
// ]);
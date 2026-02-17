<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DogController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AdopterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);






//Rutas para perros
Route::get('/dogs/{id}', [DogController::class,'showDogs'])->middleware('auth:sanctum');
Route::get('/alldogs', [DogController::class,'showAllDogs'])->middleware('auth:sanctum');

//Rutas para adoptantes
Route::get('/adopter/{id}', [AdopterController::class,'showAdopters'])->middleware('auth:sanctum');
Route::get('/alladopters' , [AdopterController::class,'showAllAdopters'])->middleware('auth:sanctum');

//Rutas para refugios
Route::get('/shelters/{id}', [ShelterController::class, 'showShelters'])->middleware('auth:sanctum');
Route::get('/allshelters', [ShelterController::class, 'allShelters'])->middleware('auth:sanctum');
//Rutas para adopciones
Route::get('/adoptions/{id}', [AdoptionController::class, 'showAdoptions'])->middleware('auth:sanctum');
Route::post('/createadoption', [AdoptionController::class, 'createAdoption'])->middleware('auth:sanctum');






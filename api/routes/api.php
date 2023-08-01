<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorPatientController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'cidades', 'as' => 'cities'], function(){
    Route::get('/', [CityController::class, 'index'])->name('.index');
    Route::get('/{id_cidade}/medicos', [CityController::class, 'doctorsByCity'])->name('.doctorsByCity');
});
Route::group(['prefix' => 'medicos', 'as' => 'doctors'], function(){
    Route::get('/', [DoctorController::class, 'index'])->name('.index')->name('.index');
    Route::post('/', [DoctorController::class, 'store'])->name('.store')->name('.store');
    Route::post('/{id_medico}/pacientes', [DoctorPatientController::class, 'linkDoctorPatient'])->name('.linkDoctorPatient');
    Route::get('/{id_medico}/pacientes', [DoctorPatientController::class, 'getDoctorPatients'])->name('.getDoctorPatients');
});

Route::group(['prefix' => 'pacientes', 'as' => 'patients'], function(){
    Route::get('/', [PatientController::class, 'index'])->name('.index');
    Route::post('/', [PatientController::class, 'store'])->name('.store');
    Route::patch('/{id_paciente}', [PatientController::class, 'update'])->name('.update');
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

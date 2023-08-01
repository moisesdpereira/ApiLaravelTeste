<?php

use App\Http\Controllers\AuthController;
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
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::group(['prefix' => 'auth', 'as' => 'auth', 'middleware' => 'apiJwt'], function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('.logou');
    Route::get('/me', [AuthController::class, 'me'])->name('.me');
    Route::get('/refresh', [AuthController::class, 'refresh'])->name('.refresh');
});

Route::group(['prefix' => 'cidades', 'as' => 'cities'], function(){
    Route::get('/', [CityController::class, 'index'])->name('.index');
    Route::get('/{id_cidade}/medicos', [CityController::class, 'doctorsByCity'])->name('.doctorsByCity');
});
Route::group(['prefix' => 'medicos', 'as' => 'doctors'], function(){
    Route::get('/', [DoctorController::class, 'index'])->name('.index')->name('.index');
    Route::post('/', [DoctorController::class, 'store'])->name('.store')->name('.store')->middleware(['apiJwt']);
    Route::post('/{id_medico}/pacientes', [DoctorPatientController::class, 'linkDoctorPatient'])->name('.linkDoctorPatient')->middleware(['apiJwt']);
    Route::get('/{id_medico}/pacientes', [DoctorPatientController::class, 'getDoctorPatients'])->name('.getDoctorPatients')->middleware(['apiJwt']);;
});

Route::group(['prefix' => 'pacientes', 'as' => 'patients', 'middleware' => 'apiJwt'], function(){
    Route::get('/', [PatientController::class, 'index'])->name('.index');
    Route::post('/', [PatientController::class, 'store'])->name('.store');
    Route::patch('/{id_paciente}', [PatientController::class, 'update'])->name('.update');
});

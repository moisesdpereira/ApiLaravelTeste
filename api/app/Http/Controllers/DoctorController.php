<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function index()
    {
        try {
            $doctors = Doctor::all();
            if ($doctors->isEmpty()) {
                return response()->json(['message' => 'Não há médicos cadastrados.'], 404);
            }
            return response()->json($doctors, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao buscar os médicos.'], 500);
        }
    }

    public function store(StoreDoctorRequest $request)
    {
        try{
            $doctor = new Doctor();
            $doctor->name       = $request->get('nome');
            $doctor->specialty  = $request->get('especialidade');
            $doctor->city_id    = $request->get('cidade_id');

            $doctor->save();

            return response()->json($doctor, 200);

        }catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao cadastrar o médico.'], 500);
        }
    }
}

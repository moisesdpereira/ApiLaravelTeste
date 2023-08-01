<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        try {
            $patients = Patient::all();

            if ($patients->isEmpty()) {
                return response()->json(['message' => 'Não há pacientes cadastrados.'], 404);
            }

            return response()->json($patients, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao buscar os pacientes.'], 500);
        }
    }

    public function store(StorePatientRequest $request)
    {
        try {
            $patient = new Patient();
            $patient->name = $request->get('nome');
            $patient->cpf = $request->get('cpf');
            $patient->cell_phone = $request->get('celular');

            $patient->save();

            return response()->json($patient, 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao cadastrar o médico.'], 500);
        }
    }

    public function update(UpdatePatientRequest $request, $id_patient)
    {
        if ($request->filled('cpf')) {
            return response()->json(['message' => 'O campo cpf não pode ser atualizado.'], 422);
        }

        try {
            $patient = Patient::findOrFail($id_patient);
            $patient->name = $request->get('nome');
            $patient->cell_phone = $request->get('celular');

            $patient->save();

            return response()->json($patient, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Paciente não encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao vincular o médico ao paciente.'], 500);
        }

    }

}

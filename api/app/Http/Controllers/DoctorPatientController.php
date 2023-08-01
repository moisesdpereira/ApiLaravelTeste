<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorPatientRequest;
use App\Models\Doctor;
use App\Models\DoctorPatient;
use App\Models\Patient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorPatientController extends Controller
{
    public function getDoctorPatients($id_medico)
    {
        try {
            $doctor = Doctor::findOrFail($id_medico);

            $patients = $doctor->patients;

            return response()->json($patients, 200);

        }catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Médico não encontrado.'], 404);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Ocorreu um erro ao buscar o médico.'], 500);
        }
    }

    public function linkDoctorPatient(StoreDoctorPatientRequest $request, $id_medico)
    {
        try {
            $doctor = Doctor::findOrFail($id_medico);

            $patient = Patient::findOrFail($request->get('paciente_id'));

            $doctorPatient = new DoctorPatient();
            $doctorPatient->doctor_id = $doctor->id;
            $doctorPatient->patient_id = $patient->id;
            $doctorPatient->save();

            return response()->json([
                'medico' => $doctor,
                'paciente' => $patient,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Médico ou paciente não encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao vincular o médico ao paciente.'], 500);
        }
    }
}

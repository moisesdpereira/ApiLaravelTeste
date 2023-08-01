<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDoctorPatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
//            'doutor_id' => 'required|exists:doctors,id',
            'paciente_id' => 'required|exists:patients,id',
        ];
    }

    public function messages()
    {
        return [
//            'doctor_id.required' => 'O campo doctor_id é obrigatório.',
//            'doctor_id.exists' => 'O doutor especificado não existe.',
            'paciente_id.required' => 'O campo paciente_id é obrigatório.',
            'paciente_id.exists' => 'O paciente especificado não existe.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}

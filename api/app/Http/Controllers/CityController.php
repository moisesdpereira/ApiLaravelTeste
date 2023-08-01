<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cities = City::all();
            if ($cities->isEmpty()) {
                return response()->json(['message' => 'Não há cidades cadastradas.'], 404);
            }
            return response()->json($cities, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao buscar as cidades.'], 500);
        }
    }

    public function doctorsByCity($id_cidade)
    {
        try {
            $city = City::findOrFail($id_cidade);
            $doctors = $city->doctors;
            return response()->json($doctors, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Cidade não encontrada.'], 404);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'Ocorreu um erro ao buscar cidade.'], 500);
        }
    }
}

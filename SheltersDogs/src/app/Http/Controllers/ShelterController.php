<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shelter;
class ShelterController extends Controller
{
    public function createShelter(Request $request)
    {
    $request->validate([
        'name' => 'required|string',
        'city' => 'required|string',
        'phone' => 'required|string'
        ]);
    $shelter = Shelter::find($request->id);
    if(!$shelter)
        {
        $shelter = Shelter::create([
            'name' => $request->name,
            'city' => $request->city,
            'phone' => $request->phone
        ]);
        return response()->json($shelter, 201);
        }else{return response()->json(['message' => 'El refugio ya existe'], 400);
    }
    }
    public function showShelters(Request $request)
    {
        $shelters = Shelter::all();
        return response()->json($shelters);
    }

    public function addDogToShelter(Request $request, $shelter_id)
    {
        $request->validate([
            'name' => 'required|string',
            'breed' => 'required|string',
            'birth_date' => 'required|integer'
        ]);
        $shelter = Shelter::find($shelter_id);
        if (!$shelter) {
            return response()->json(['message' => 'Refugio no encontrado'], 404);
        }
        $dog = $shelter->dogs()->create([
            'name' => $request->name,
            'breed' => $request->breed,
            'birth_date' => $request->birth_date,
            'status' => 'available'
        ]);
        return response()->json($dog, 201);
    }
}
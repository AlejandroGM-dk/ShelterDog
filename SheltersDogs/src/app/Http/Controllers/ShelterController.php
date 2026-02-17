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
    
    public function index()
    {
        $shelters = Shelter::withCount(['dogs as total_dogs', 'dogs as adopted_dogs_count' => function($q){
            $q->where('status', 'adopted');
        }])->get();
        return response()->json($shelters);
    }
public function allShelters() 
    {
        try{

        $shelters = Shelter::withCount(['dogs as total_dogs', 'dogs as adopted_dogs_count' => function($q){
            $q->where('status', 'adopted');
        }])->get();

            
            return response()->json($shelters);
        }catch(\Exception $e) {  
            return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ], 500);}
    }
        public function showShelters($id) 
    {
    try{
        if($id==0){return response()->json(Shelter::all());}
        $shelter = Shelter::with('dogs:id,name,breed,status,shelter_id')->findOrFail($id);
        return response()->json($shelter);
        }catch(\Exception $e) {  
            return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ], 500);}
        
    }
    

}
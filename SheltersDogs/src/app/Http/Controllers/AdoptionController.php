<?php

namespace App\Http\Controllers;
use App\Models\Adoptions;
use App\Models\Dog;
use Illuminate\Http\Request;
use App\Models\Adopter;

class AdoptionController extends Controller
{
    //

    public function index()
    {
        $adoptions = Adoptions::with(['dog', 'adopter'])->get();
        return response()->json($adoptions);
    }

    public function showAdoptions($id){
        $adopter = Adopter::with('adoptions.dog:id,name,breed')->findOrFail($id);

        $adopted_dogs = $adopter->adoptions->map(function($adoption){
            return [
                'id'=>$adoption->dog->id,
                'name'=>$adoption->dog->name,
                'breed'=>$adoption->dog->breed,
                'adoption_date'=>$adoption->adoption_date
            ];
        });

        return response()->json([
            'id'=>$adopter->id,
            'name'=>$adopter->name,
            'email'=>$adopter->email,
            'adopted_dogs'=>$adopted_dogs
        ]);
    }

   public function createAdoption(Request $request)
{
    $request->validate([
        'dog_id' => 'required|exists:dogs,id',
        'adopter_id' => 'required|exists:adopters,id',
        'adoption_date' => 'required|date',
        'fee_paid' => 'required|numeric'
    ]);

    try {
        $dog = Dog::findOrFail($request->dog_id);

        if ($dog->status === 'adopted') {
            return response()->json(['message' => 'El perro ya ha sido adoptado'], 400);
        }

        $adoption = Adoptions::create([
            'dog_id' => $request->dog_id,
            'adopter_id' => $request->adopter_id,
            'adoption_date' => $request->adoption_date,
            'fee_paid' => $request->fee_paid
        ]);

        // Cargar la relación adopter
        $adoption->load('adopter');

        $dog->status = 'adopted';
        $dog->save();

        return response()->json([
            'adoption' => $adoption,
            'dog' => $dog,
            'adopter' => $adoption->adopter // ahora sí traerá los datos
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al crear la adopción',
            'error' => $e->getMessage()
        ], 500);
    }
}


}
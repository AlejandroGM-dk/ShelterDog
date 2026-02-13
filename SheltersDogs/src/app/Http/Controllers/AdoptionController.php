<?php

namespace App\Http\Controllers;
use App\Models\Adoptions;
use App\Models\Dog;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    //




    public function createAdoption(Request $request)
    {
      $request->validate([
            'dog_id' => 'required|exists:dogs,id',
            'adopter_id' => 'required|exists:adopters,id',
            'adoption_date' => 'required|date'
        ]);
     $dog = Dog::find($request->dog_id);


      if($dog->status == 'adopted'){
            return response()->json(['message' => 'El perro ya ha sido adoptado'], 400);
        }else{
            $adoption = Adoptions::create([
                'dog_id' => $request->dog_id,
                'adopter_id' => $request->adopter_id,
                'adoption_date' => $request->adoption_date
            ]);
            $dog->status = 'adopted';
            $dog->save();
            return response()->json($adoption, 201);
        }
    }
}
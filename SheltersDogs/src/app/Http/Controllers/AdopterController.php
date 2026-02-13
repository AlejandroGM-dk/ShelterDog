<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopter;
class AdopterController extends Controller
{
    // 
    public function createAdopter(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:adopters,email',
            'phone' => 'required|string'
        ]);

        $adopter = Adopter::find($request->id);
        if(!$adopter){   
            $adopter = Adopter::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
            return response()->json($adopter, 201);
        } else {
            return response()->json(['message' => 'El adoptante ya existe'], 400);
        }

    }
}

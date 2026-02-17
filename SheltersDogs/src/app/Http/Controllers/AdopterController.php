<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adopter;
class AdopterController extends Controller
{
    // 
public function index() 
    {
        $adopters = Adopter::with('adoptions.dog')->get();
        return response()->json($adopters);
    }

    public function showAdopters($id) {
        
    
    try{
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
    }catch(\Exception $e){
        return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ], 500);
    }
    
    
    }
    //return only data of adopter and total dogs adopted,
    public function showAllAdopters() 
    {
        try{
        $adopters = Adopter::withCount('adoptions as total_adopted_dogs')->get();
        return response()->json($adopters);
        }catch(\Exception $e) {  
            return response()->json([
            'error' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ], 500);}       
    }




}
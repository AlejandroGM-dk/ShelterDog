<?php

namespace App\Http\Controllers;
use App\Models\Dog;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class DogController extends Controller
{
    //


    public function createDog(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'breed' => 'required|string',
            'birth_date' => 'required|integer',
            'shelter_id' => 'required|exists:shelters,id'
        ]);
        $dog=Dog::create([
            'name'=>$request->name,
            'breed'=>$request->breed,
            'birth_date'=>$request->birth_date,
            'shelter_id'=>$request->shelter_id, 
        ]);
        return response()->json($dog, 201);
    }


    public function modifyDog(Request $request, $id)
    {
        //buscamos el perro por su id
        $dog = Dog::find($id);
        if (!$dog) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
            //si el perro no existe retonamos un error 404 y un json con el mensaje de error
        }
        //validamos los datos de entrada
        $request->validate([
            'name' => 'sometimes|required|string',
            'breed' => 'sometimes|required|string',
            'birth_date' => 'sometimes|required|integer',
            'shelter_id' => 'sometimes|required|exists:shelters,id']);
        $dog->update($request->all());
        return response()->json($dog);   
    }
    //Metodo para eliminar un perro
    public function deleteDog($id)
    {
        $dog = Dog::find($id);
        if (!$dog) {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }
        $dog->delete();
        return response()->json(['message' => 'Perro eliminado']);
    }  

    public function index()
    {
        $dogs = Dog::with('shelter:id,name')->get()->map(function($dog){
            return [
                'id'=>$dog->id,
                'name'=>$dog->name,
                'breed'=>$dog->breed,
                'birth_date'=>$dog->birth_date,
                'status'=>$dog->status,
                'shelter_name'=>$dog->shelter->name ?? null,
            ];
        });

        return response()->json($dogs);
    }


    public function showAllDogs()
    {
        $dogs = Dog::with('shelter:id,name')->get()->map(function($dog){
            return [
                'id'=>$dog->id,
                'name'=>$dog->name,
                'breed'=>$dog->breed,
                'birth_date'=>$dog->birth_date,
                'status'=>$dog->status,
                'shelter_name'=>$dog->shelter->name ?? null,
            ];
        });

        return response()->json($dogs);


    }




    //adoption=adopter_name,adoption_date,fee_paid
    public function showDogs($id)
    {
    $dog = Dog::with(['shelter', 'adoption'])->findOrFail($id);
        return response()->json([
            'id'=>$dog->id,
            'name'=>$dog->name,
            'breed'=>$dog->breed,
            'birth_date'=>$dog->birth_date,
            'status'=>$dog->status,
            'shelter'=>$dog->shelter ?? null,
            'adopter_name'=>$dog->adoption->adopter_name ?? null,
            'adoption_date'=>$dog->adoption->adoption_date ?? null,
            'fee_paid'=>$dog->adoption->fee_paid ?? null,
        ]);
    }

}




























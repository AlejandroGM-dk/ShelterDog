<?php

namespace App\Http\Controllers;
use App\Models\Dog;
use Illuminate\Http\Request;

class DogController extends Controller
{
    //
    public function index(Request $request)
    {
        $dogs = Dog::all();
        return response()->json($dogs);
    }

    public function findDog($id)
    {
        $dog = Dog::find($id);
        if ($dog) {
            return response()->json($dog);
        } else {
            return response()->json(['message' => 'Perro no encontrado'], 404);
        }
    }

      // Método para crear un nuevo perro
     // El método recibe una solicitud HTTP con los datos del perro a crear, valida los datos y luego crea un nuevo registro en la base de datos. 
    //Si la creación es exitosa, devuelve una respuesta JSON con el nuevo perro y un código de estado 201 (creado).
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


    //Metodo para mostrar todos los perros disponibles en la base de datos.
    public function showDogs(Request $request)
    {
    $dogs = Dog::all();
    return response()->json($dogs);}


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

























}

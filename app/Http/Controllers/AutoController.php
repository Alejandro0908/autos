<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auto;


class AutoController extends Controller
{

    //Metodo para crear los registros autos
    public function store(Request $request)
    {
        $request->validate([
            "modelo" => 'required|string|max:100|min:5',
            "descripcion" => 'required|string|max:100|min:5',
            "precio" => 'required|numeric|min:0',
            "estado" => 'required|string|max:100|min:5',

        ]);


        //Valido y creo el nuevo registro en la tabla autos
        //$auto = Auto::create($request->only('modelo', 'descripcion , precio, estado'));
        $auto = Auto::create($request->all());

        //redirecccion
        return redirect("/auto/{$auto->id}");




        return response()->json(['message' => 'Auto creado con éxito'], 200);
    }

    //Metodo para obtener los registros de la tabla autos
    public function index()
    {
        // Obtener los autos con paginación de 25 registros por página
        $auto = Auto::paginate(25);
        // Retornar la vista con los datos paginados
        return view('automovil.index', compact('auto'));
    }

    public function update(Request $request, Auto $auto)
    {
        // Actualiza el auto con los datos del request
        $auto->update($request->all());
    
        // Redirige a la ruta 'automovil.index'
        return redirect()->route('automovil.index')->with('success', 'Auto actualizado correctamente');
    }
    

    //Método para editar los registros de la tabla auto
    public function show(Auto $auto)
    {
        return view('automovil.show', compact('auto'));
    }

    // Método para eliminar un registro de la base temporal
    public function destroy(Auto $auto)
    {
        // Eliminar el auto
        $auto->delete();

        // Responder confirmación de eliminación
        return response()->json(['message' => 'Auto eliminado con éxito'], 200);
    }

    
}

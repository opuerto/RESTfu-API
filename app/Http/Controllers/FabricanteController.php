<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fabricante;

class FabricanteController extends Controller
{
     public function __construct() 
    {
        $this->middleware('auth.basic.once',['only' =>['index','store','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index()
    {

        return response()->json(['datos'=>Fabricante::all()],200);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        if(!$request->input('nombre') || !$request->input('telefono'))
        {
             return response()->json(['mensaje' => 'No se pudieron procesar los valores','codigo' => 422],422);
        }
        Fabricante::create($request->all());
        return response()->json(['mensaje' => 'Fabricante insertado'],201);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $fabricante = Fabricante::find($id);

        if(!$fabricante) 
        {
            return response()->json(['mensaje'=>'No se encuentra este fabricante', 'codigo'=>404],404);
        }

        return response()->json(['datos'=>$fabricante],200);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $nombre = $request->input('nombre');
        $telefono = $request->input('telefono');
        //averiguamos que metodos estamos usando 
        $metodo = $request->method();
        //validamos que exista un fabricante con el id enviado por la url

        $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra este fabricante', 'codigo'=>404],404);   
        }
        if ($metodo === 'PATCH') {
            //metodo patch podemos adquirir algunos de los valores del fabricante para hacer la actualizacion correspondiente
            $bandera = false;
            if ($nombre != null && $nombre != '') {
                $fabricante->nombre = $nombre;  
                $bandera = true;  
            }

            if ($telefono != null && $telefono != '') {
                $fabricante->telefono = $telefono;  
                $bandera = true;
            }
            if ($bandera) {
               $fabricante->save();
            
            return response()->json(['mensaje' => 'Fabricante modificado'],200);
            }
            return response()->json(['mensaje' => 'No se modifico ningun fabricante'],304);

            
        }

        //Con put actualiza el conjunto completo en teoria deberiamos requerir todos los datos 
        //del fabricante para hacer una actualizacion 
        if (!$nombre || !$telefono) {
             return response()->json(['mensaje' => 'No se pudieron procesar los valores','codigo' => 422],422);    
        }

         $fabricante->nombre = $nombre; 
         $fabricante->telefono = $telefono; 
         $fabricante->save();
          return response()->json(['mensaje' => 'Fabricante modificado'],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
          $fabricante = Fabricante::find($id);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra este fabricante', 'codigo'=>404],404);   
        }
        $vehiculos = $fabricante->vehiculos; // si no ponemos los parentesis obtenemos simplemente el array

        if (sizeof($vehiculos) > 0) {
            return response()->json(['mensaje'=>'Este fabricante posee vehiculos asociados por lo tanto no se puede borrar, Eliminar primero sus vehiculos asociados', 'codigo'=>409],409);   
        }

         $fabricante->delete();   
         return response()->json(['mensaje' => 'Fabricante eliminado'],200);
    }
}

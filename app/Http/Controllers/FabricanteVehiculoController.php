<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fabricante;
use App\Vehiculo;

class FabricanteVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

     public function __construct() 
    {
        $this->middleware('auth.basic',['only' =>['store','update','destroy']]);
    }

    public function index($id)
    {
       
        $fabricante = Fabricante::find($id);
        
         if(!$fabricante) 
        {
            return response()->json(['mensaje'=>'No se encuentra este fabricante', 'codigo'=>404],404);
        }

        $vehiculos_fabricante = $fabricante->vehiculos()->get();

        return response()->json(['datos'=>$vehiculos_fabricante],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        return 'mostrando formulario para agregar al fabricante'.$id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, $id)
    {
        //fabricante_id
        //color 
        //cilindraje
        //potencia 
        //peso
        if(!$request->input('color') || !$request->input('cilindraje') || !$request->input('potencia') || !$request->input('peso') ) 
        {
            return response()->json(['mensaje' => 'No se pudieron procesar los valores','codigo' => 422],422);
        }

        $fabricante = Fabricante::find($id);

        if (!$fabricante)
        {
          return response()->json(['mensaje' => 'no existe el fabricante asociado','codigo'=>404],404);  
        }

        $fabricante->vehiculos()->create($request->all()); // accedemos a la relacion vehiculos en la clase Fabricante

        return response()->json(['mensaje' => 'Vehiculo insertado'],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($idfabricante, $idvehiculo)
    {
        return 'mostrando vehiculo' . $idvehiculo . 'del fabricante '.$idfabricante;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idfabricante, $idvehiculo)
    {
        return 'Mostrando formulario para editar el vehiculo'. $idvehiculo . 'del fabricante '.$idfabricante;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $idfabricante, $idvehiculo)
    {
         $color = $request->input('color');
        $cilindraje = $request->input('cilindraje');
        $potencia = $request->input('potencia');
        $peso = $request->input('peso');
        //averiguamos que metodos estamos usando 
        $metodo = $request->method();
        //validamos que exista un fabricante con el id enviado por la url

        $fabricante = Fabricante::find($idfabricante);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra este fabricante', 'codigo'=>404],404);   
        }
        //encontramos el vehiculo del fabricante 
        $vehiculo = $fabricante->vehiculos()->find($idvehiculo);

        if (!$vehiculo) {
            return response()->json(['mensaje'=>'No se encuentra el vehiculo asociado a ese fabricante', 'codigo'=>404],404);   
        }

        if ($metodo === 'PATCH') {
            //metodo patch podemos adquirir algunos de los valores del fabricante para hacer la actualizacion correspondiente
            $bandera = false;
            if ($color != null && $color != '') {
                $vehiculo->color = $color;  
                $bandera = true;  
            }

            if ($cilindraje != null && $cilindraje != '') {
                $vehiculo->cilindraje = $cilindraje; 
                $bandera = true; 
            }

             if ($potencia != null && $potencia != '') {
                $vehiculo->potencia = $potencia; 
                $bandera = true; 
            }

            if ($peso != null && $peso != '') {
                $vehiculo->peso = $peso; 
                $bandera = true; 
            }

            

            if ($bandera) {
                //bandera para asegurar de que no se enviaron todos los datos vacios
                 $vehiculo->save();
            
                return response()->json(['mensaje' => 'Vehiculo modificado'],200);
            }

            return response()->json(['mensaje' => 'No se modifico ningun vehiculo'],304);
           
        }

        //Con put actualiza el conjunto completo en teoria deberiamos requerir todos los datos 
        //del fabricante para hacer una actualizacion 
        if (!$color || !$potencia || !$cilindraje || !$peso) {
             return response()->json(['mensaje' => 'No se pudieron procesar los valores','codigo' => 422],422);    
        }

          $vehiculo->color = $color; 
          $vehiculo->cilindraje = $cilindraje;
          $vehiculo->potencia = $potencia;
          $vehiculo->peso = $peso;   
          $vehiculo->save();
          return response()->json(['mensaje' => 'vehiculo modificado'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idfabricante, $idvehiculo)
    {
        $fabricante = Fabricante::find($idfabricante);
        if (!$fabricante) {
            return response()->json(['mensaje'=>'No se encuentra este fabricante', 'codigo'=>404],404);   
        }
        //encontramos el vehiculo del fabricante 
        $vehiculo = $fabricante->vehiculos()->find($idvehiculo);

        if (!$vehiculo) {
            return response()->json(['mensaje'=>'No se encuentra el vehiculo asociado a ese fabricante', 'codigo'=>404],404);   
        }

        $vehiculo->delete();

         return response()->json(['mensaje' => 'vehiculo eliminado'],200);

    }
}

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
    public function store()
    {
        //
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
    public function update($idfabricante, $idvehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idfabricante, $idvehiculo)
    {
        //
    }
}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fabricante;

class FabricanteController extends Controller
{
     public function __construct() 
    {
        $this->middleware('auth.basic',['only' =>['store','update','destroy']]);
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return 'mostrando formulario para crear un fabricante';
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return 'Mostrando formulario para editar al fabricante con id'.$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

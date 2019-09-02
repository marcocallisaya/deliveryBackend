<?php

namespace App\Http\Controllers\Empleado;

use App\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\EmpleadoTransformer;

class EmpleadoController extends ApiController
{
    public function __construct()
    {
        $this->middleware('transform:' . EmpleadoTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $empleados = Empleado::all();

        return $this->showAll($empleados,200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:clientes',
            'password' => 'required|min:6', 
            'direction' => 'required', 
            'phone' => 'required', 
            'carnet' => 'required',
            'position'=> 'required',
            'sucursal_id' => 'required'
        ];

    $this->validate($request,$rules);

    $data = $request->all();

    $data['password'] = bcrypt($request->password);

    $empleado = Empleado::create($data);
    
    $empleado->save();

    return $this->showOne($empleado,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        return $this->showOne($empleado,200);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $data = $request->all();

        if ($request->has('password'))
        {
            $data['password'] = bcrypt($request->password);
        }

        $empleado->fill($data);

        if ($empleado->isClean())
        {
            return $this->errorResponse('Debes actualizar algun campo',404);
        }

        $empleado->save();

        return $this->showOne($empleado);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return $this->showOne($empleado);
    }
//-------------------------------------------->>>-->-<-->-->



    
}

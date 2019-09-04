<?php

namespace App\Http\Controllers\Sucursal;

use App\Http\Controllers\ApiController;
use App\Sucursal;
use App\Transformers\SucursalTransformer;
use Illuminate\Http\Request;

class SucursalController extends ApiController
{
    public function __construct()
    {
        
        $this->middleware('jwt', ['except' => ['login']]);
        $this->middleware('transform:' . SucursalTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Sucursal::all();

        return $this->showAll($sucursales,200);
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
            'direction' => 'required',
            'city' => 'required',
            'phone'  => 'required'
        ];

       // $this->validate($request,$rules);

        $data = $request->all();

        $sucursal = Sucursal::create($data);

        $sucursal->save();

        return $this->showOne($sucursal,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal)
    {
        return $this->showOne($sucursal,200);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $data = $request->all();

        $sucursal->fill($data);

        if ($sucursal->isClean())
        {
            return $this->errorResponse('Necesitas cambiar algun campo para actualiar',404);
        }

        $sucursal->save();


        return $this->showOne($sucursal,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();

        return $this->showOne($sucursal,200);
    }
}

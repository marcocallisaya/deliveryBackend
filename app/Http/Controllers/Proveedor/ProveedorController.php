<?php

namespace App\Http\Controllers\Proveedor;

use App\Proveedor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\ProveedorTransformer;

class ProveedorController extends ApiController
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
        $this->middleware('transform:' . ProveedorTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();

        return $this->showAll($proveedores,200);
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
            'name'=>'required',
            'direction'=>'required',
            'city'=>'required',
            'phone'=>'required',
            'description'=>'required'
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $proveedor = Proveedor::create($data);

        $proveedor->save();


        return $this->showOne($proveedor,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedore)
    {
        return $this->showOne($proveedore,200);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedore)
    {
        $data = $request->all();

        $proveedore->fill($data);

        if ($proveedore->isClean())
        {
            return $this->errorResponse('Cambia algun campo para actualiar',404);
        }

        $proveedore->save();

        return $this->showOne($proveedore,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();

        return $this->showOne($proveedore,200);
    }
}

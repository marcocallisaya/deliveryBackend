<?php

namespace App\Http\Controllers\Producto;

use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\ProductoTransformer;
use Illuminate\Support\Facades\Storage;

class ProductoController extends ApiController
{
    public function __construct()
    {
        $this->middleware('transform:' . ProductoTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();

        return $this->showAll($productos,200);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

   
  /*       $rules = [
            'name'=>'required',
            'price'=>'required',
            'img'=>'required',
            'stock'=>'required',
            'state'=>'required',
            'proveedor_id'=>'required',
            'categoria_id'=>'required'
        ];

        $this->validate($request,$rules); */

        $data = $request->all();
        
        $data['img'] = $request->img->store('');
        
        $producto = Producto::create($data);

        $producto->save();


        return $this->showOne($producto,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return $this->showOne($producto,200);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $data = $request->except(['img']);

        $producto->fill($data);

        if ($request->hasFile('img')) {
            Storage::delete($producto->img);
            $producto->img = $request->img->store('');
        }

       

        if ($producto->isClean())
        {
            return $this->errorResponse('Cambia algo para actualizar',404);
        }

        $producto->save();

        return $this->showOne($producto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        Storage::delete($producto->img);
        $producto->delete();

        return $this->showOne($producto,200);
    }
}

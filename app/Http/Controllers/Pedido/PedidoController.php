<?php

namespace App\Http\Controllers\Pedido;

use App\Pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\PedidoTransformer;

class PedidoController extends ApiController
{
    public function __construct()
    {
       // $this->middleware('jwt', ['except' => ['login']]);
        $this->middleware('transform:' . PedidoTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();

        return $this->showAll($pedidos,200);
    }


    public function busqueda(Request $request)
    {
        $filtro = $request->filtro;
       $pedidos = Pedido::where('id','=',$filtro)->get();
    
       
        return 
        $this->showAll($pedidos);
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
            'price'=>'required',
            'state'=>'required',
            'cliente_id'=>'required',
            'empleado_id'=>'required'
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        

        $pedido = Pedido::create($data);

        $pedido->save();

        return $this->showOne($pedido);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        return $this->showOne($pedido,200);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->all();

        $pedido->fill($data);

        if ($pedido->isClean())
        {
            return $this->errorResponse('Necesitas cambiar algo',404);
        }

        $pedido->save();

        return $this->showOne($pedido);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return $this->showOne($pedido);
    }
}

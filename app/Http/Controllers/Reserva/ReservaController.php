<?php

namespace App\Http\Controllers\Reserva;

use App\Reserva;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Pedido;
use App\Transformers\ReservaTransformer;
use Illuminate\Support\Facades\DB;

class ReservaController extends ApiController
{
    public function __construct()
    {
        $this->middleware('transform:' . ReservaTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reserva::all();

        return $this->showAll($reservas,200);
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
            'pedido_id'=>'required',
            'amountPending'=>'required',
            'amountGiven'=>'required',
            'date' =>'required'
        ];

        $this->validate($request,$rules);

        $data = $request->all();
        
       

        

        $reserva = Reserva::create($data);

        $reserva->save();

        return $this->showOne($reserva,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        return $this->showOne($reserva,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        $data = $request->all();

        $reserva->fill($data);

        if ($reserva->isClean())
        {
            return $this->errorResponse('Tienes que modificar algun campo',404);
        }

        $reserva->save();

        return $this->showOne($reserva,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        
          $pedido_id = $reserva->pedido_id;

           $pedido = Pedido::findOrFail($pedido_id);

        $pedido->state = Pedido::FINALIZADO;

        $pedido->save();

        

       $productos = $pedido->productos;

        $datos = [];

        foreach ($productos as $key => $producto) {
            
            $producto_id = $producto->id;

         $cantidad =   DB::table('pedido_producto')
        ->where('pedido_id', $pedido_id)
        ->where('producto_id', $producto_id)->value('quantity');
        
        //$datos[$key]= $cantidad;

        $producto->order = $producto->order-$cantidad;

        $producto->save();

           
        }

        $reserva->delete();

        return $this->showOne($reserva,200);

       
    }
}

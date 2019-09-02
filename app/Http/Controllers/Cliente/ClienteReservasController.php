<?php

namespace App\Http\Controllers\Cliente;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ClienteReservasController extends ApiController
{
    public function index(Cliente $cliente)
    {
        $reservas = $cliente->pedidos()->whereHas('reserva')->with('reserva')
        ->get()
        ->pluck('reserva')
        ;

        return $this->showAll($reservas,200);
    }
}

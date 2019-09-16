<?php

namespace App\Http\Controllers\Administrador;

use App\Administrador;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class AdministradorController extends ApiController
{
    public function __construct()
    {
       // $this->middleware('jwt', ['except' => ['login']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminstradores = Administrador::all();

        return $this->showAll($adminstradores);
    }

   


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador $administradore)
    {
        return $this->showOne($administradore,200);
    }


    
}

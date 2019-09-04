<?php

namespace App\Http\Controllers\Conductor;

use App\Conductor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ConductorController extends ApiController
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conductores =Conductor::all();

        return $this->showAll($conductores);
    }

  


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Conductor $conductore)
    {
        return $this->showOne($conductore,200);
    }


}

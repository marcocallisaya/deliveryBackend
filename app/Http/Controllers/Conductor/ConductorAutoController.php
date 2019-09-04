<?php

namespace App\Http\Controllers\Conductor;

use App\Conductor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ConductorAutoController extends ApiController
{
    public function index(Conductor $conductor)
    {
        $auto = $conductor->auto;

        return $this->showOne($auto,200);
    }
}

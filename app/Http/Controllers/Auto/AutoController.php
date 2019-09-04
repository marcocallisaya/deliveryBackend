<?php

namespace App\Http\Controllers\Auto;

use App\Auto;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\AutoTransformer;

class AutoController extends ApiController
{
    public function __construct()
    {
       
            $this->middleware('jwt', ['except' => ['login']]);       
        $this->middleware('transform:' . AutoTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autos = Auto::all();

        return $this->showAll($autos,200);
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
            'modelo'=>'required',
            'placa'=>'required',
            'conductor_id'=>'required'
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $auto = Auto::create($data);

        $auto->save();

        return $this->showOne($auto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Auto $auto)
    {
        return $this->showOne($auto);
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auto $auto)
    {
        $data = $request->all();

        $auto->fill($data);

        if ($auto->isClean())
        {
            return $this->errorResponse('Debes cambiar algo antes de actualizar',401);
        }

        $auto->save();

        return $this->showOne($auto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

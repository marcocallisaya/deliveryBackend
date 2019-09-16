<?php

namespace App\Http\Controllers\Categoria;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\CategoriaTransformer;

class CategoriaController extends ApiController
{
    public function __construct()
    {
       // $this->middleware('jwt', ['except' => ['login']]);
        $this->middleware('transform:' . CategoriaTransformer::class)->only(['store','update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();

        return $this->showAll($categorias,200);
    }

    public function busqueda(Request $request)
    {
        $filtro = $request->filtro;
       $categorias = Categoria::where('name', 'like','%'.$filtro.'%')->get();
       collect($categorias)->filter(function ($item) use ($filtro) {
        // replace stristr with your choice of matching function
        return false !== stristr($item->name, $filtro);
    });
        return 
        $this->showAll($categorias);
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
            'description'=>'required'
        ];


        $this->validate($request,$rules);

        $data = $request->all();

        $categoria = Categoria::create($data);

        $categoria->save();

        return $this->showOne($categoria,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return $this->showOne($categoria,200);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->all();

        $categoria->fill($data);

        if ($categoria->isClean())
        {
            return $this->errorResponse('Cambia algun campo para actualizar',404);
        }

        $categoria->save();

        return $this->showOne($categoria,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return $this->showOne($categoria,200);
    }
}

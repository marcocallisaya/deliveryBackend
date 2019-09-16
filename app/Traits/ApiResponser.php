<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error'=>$message],$code);
    }

    protected function showAll(Collection $collection, $code=200)
    {

        $transformer = $collection->first()->transformer;

       // $collection = $this->filterData($collection,$transformer);
        $collection = $this->sortData($collection,$transformer);
      //  $collection = $this->pagination($collection,$transformer);
        $collection = $this->transformData($collection,$transformer);
        return $this->successResponse($collection,$code);
    }

    protected function showOne(Model $instance, $code=200)
    {
        $transformer = $instance->transformer;
        $instance= $this->transformData($instance,$transformer);
        return $this->successResponse($instance,$code);
    }

    //--------------------------------------------------------------------//

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data,new $transformer);

        return $transformation->toArray();
    }

    protected function sortData(Collection $collection,$transformer)
    {
        if (request()->has('sort_by'))
        {
            $atribute = $transformer::original(request()->sort_by) ;
            $collection = $collection->sortBy->{$atribute};
        }

        return $collection;
    }


    protected function filterData(Collection $collection, $transformer)
    {
        foreach (request()->query() as $query => $value) 
        {
            $attribute = $transformer::original($query);

            if(isset($attribute,$value))

            {
                $collection = $collection->where($attribute,$value);
                
            }
        }
        return $collection;
    }

    protected function pagination(Collection $collection, $transformer)
    {
        $rules = ['per_page' => 'integer|min:2|max:20'];

        Validator::validate(request()->all(),$rules);

        $page = LengthAwarePaginator::resolveCurrentPage();

        $per_page = 5;

        if (request()->has('per_page'))
        {
            $per_page = request()->per_page;
        }

        $results = $collection->slice(($page-1)*$per_page,$per_page)->values();

        $paginated = new LengthAwarePaginator($results,$collection->count(),$per_page,$page,[
            'path' => LengthAwarePaginator::resolveCurrentPath(),]);

        $paginated->appends(request()->all());

        return $paginated;

    }
}
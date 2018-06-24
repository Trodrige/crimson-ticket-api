<?php namespace App\Http\Controllers;
use App\Http\Middleware\Authenticate;

class CarsController extends Controller {

    const MODEL = "App\Car";

    use RESTActions;


/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	//uncomment this middle ware to allow only specific logged in userr access this resource.
        //$this->middleware(Authenticate::class);
    }
    public function setType(Request $request, $id)
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        $model = $m::find($id);
        $model->type = $request->type;
        if(is_null($model)){
            return $this->respond(Response::HTTP_NOT_FOUND);
        }
        $model->update(['type'=> $request]);
        return $this->respond(Response::HTTP_OK, $model);
    }
}

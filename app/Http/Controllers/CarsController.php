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
}

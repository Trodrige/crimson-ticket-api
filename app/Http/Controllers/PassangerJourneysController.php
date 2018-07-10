<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PassangerJourneysController extends Controller {

    const MODEL = "App\PassangerJourney";

    use RESTActions;

        public function all()
		    {
		        $m = self::MODEL;
		        return $this->respond(Response::HTTP_OK, $m::allTransactions());
		    }

		    public function get($id)
		    {
		        $m = self::MODEL;
		        $model = $m::getTransaction($id);
		        if(is_null($model)){
		            return $this->respond(Response::HTTP_NOT_FOUND);
		        }
		        return $this->respond(Response::HTTP_OK, $model);
		    }
}

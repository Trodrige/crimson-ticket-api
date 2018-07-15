<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Transaction;
use App\Journey;

class PassangerJourneysController extends Controller {

    const MODEL = "App\PassangerJourney";

//all passengers on all journeys
public function all()
    {
        $m = self::MODEL;
        return $this->respond(Response::HTTP_OK, $m::allTransactions());
    }


//all passengers on specific journey with specified id as $journey
public function get($journey)
{
	$journey = Journey::find($journey);
	$transactions = $journey->transactions()->distinct()->get();
	// return $transactions;
	// $model = Transaction::where('journey_id',$journey)->groupBy('journey_id')->get();
        if(is_null($transactions)){
            return response()->json([], Response::HTTP_NOT_FOUND);
        }
        return response()->json($transactions, Response::HTTP_OK);
}

//returs details on the passenger with specified cni and the journey which he/she is in.
public function getTransactionByUserCNI($cni)
    {
        $model = Transaction::where('cni',$cni)->get();
        if(is_null($model)){
            return response()->json([], Response::HTTP_NOT_FOUND);
        }
        return response()->json($model, Response::HTTP_OK);
    }


      
      protected function respond($status, $data = [])
    {
        return response()->json($data, $status);
    }
}

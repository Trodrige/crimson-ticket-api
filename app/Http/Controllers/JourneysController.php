<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JourneysController extends Controller {

    const MODEL = "App\Journey";

    use RESTActions;
    public static $searchRules = [
        // Validation rules
        'destination' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'departure_time' => 'required',
    ];

    public function search(Request $request)
    {
        $m = self::MODEL;
        $this->validate($request, $searchRules);
        return $this->respond(Response::HTTP_OK, $m::where("destination", $request->destination)->orWhere("amount",$request->amount)->orWhere("departure_time",$request->departure_time)->all());
    }

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Journey;
use App\Transaction;

class PassangerJourney extends Model {

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    protected $appends = ['transaction'];


    // Relationships

    public function journey($value='')
    {
    	# code...
    }

    public function getTrasactionAttributes()
    {
    	return Transaction::all();
    }

    public static function allTransactions()
    {
    	return Transaction::get();
    }

    public static function userTransaction($value='')
    {
    	return Transaction::find($value);
    }
}

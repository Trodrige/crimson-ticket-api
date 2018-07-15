<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Journey;
use App\Transaction;

class PassangerJourney extends Model {
    //this model doesnot have a mapping to the database.
    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    //protected $appends = ['transaction'];
    
    // protected $hidden = [
    //     'id', 'user_id',
    // ];

    // Relationships

    public function journey($value='')
    {
    	# code...
    }

    public function getTrasactionAttributes()
    {
    	return Transaction::all();
    }

    //returns all passengers on all journeys
    public static function allTransactions()
    {
    	return Transaction::all();
    }
 
}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Journey;

class Transaction extends Model {

    protected $fillable = [
        'firstname', 'lastname', 'phone', 'cni', 'seat', 'journey_id',
    ];

    protected $dates = [];

    protected $appends = ['journey'];


    public static $rules = [
        // Validation rules
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'phone' => 'required',
        'cni' => 'required|string|max:255',
        'seat' => 'required|numeric',
        'journey_id' => 'required|numeric',
    ];

    // Relationships

    /**
     * Get the journey this transaction belongs to.
     */
     public function journey()
     {
         return $this->belongsTo('App\Journey');
     }

     public function getJourneyAttribute()
     {
        return Journey::find($this->attributes['journey_id']);

     }

}

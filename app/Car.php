<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model {

    protected $fillable = [
        'car_num', 'type', 'num_of_seats', 'user_id',
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
        'car_num' => 'required|string|max:255',
        'type' => 'required',
        'num_of_seats' => 'required|numeric',
        'user_id' => 'required|numeric',
    ];

    // Relationships

    /**
     * Get the journeys undertaken by this car.
     */
    public function journeys()
    {
        return $this->hasMany('App\Journey');
    }

    /**
     * Get the user who created this car.
     */
     public function user()
     {
         return $this->belongsTo('App\User');
     }
}

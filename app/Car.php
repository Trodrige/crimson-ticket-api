<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Car extends Model {

    protected $fillable = [
        'car_num', 'type', 'num_of_seats', 'user_id',
    ];

    protected $dates = [];

    protected $appends = ['user'];

    public static $rules = [
        // Validation rules
        'car_num' => 'required|string|max:255',
        'type' => 'required',
        'num_of_seats' => 'required|numeric',
        'user_id' => 'required|numeric',
    ];

  protected $hidden = [
        'id', 'user_id',
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



      public function getUserAttribute()
      {

         return User::find($this->attributes['user_id']);
      }
}

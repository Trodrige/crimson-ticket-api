<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Car;


class Journey extends Model {

    protected $fillable = [
        'departure', 'destination', 'driver', 'amount', 'departure_time', 'departure_date', 'car_id', 'user_id',
    ];

    protected $dates = [];
        /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'user_id', 'car_id',
    ];

    protected $appends = ['car', 'user'];

    public static $rules = [
        // Validation rules
        'departure' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'driver' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'departure_time' => 'required',
        'departure_date' => 'required',
        'car_id' => 'required|numeric',
        'user_id' => 'required|numeric',
    ];

    // Relationships

    /**
     * Get the transactions registered under this journey.
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    /**
     * Get the user who created this journey.
     */
     public function user()
     {
         return $this->belongsTo('App\User');
     }

     /**
      * Get the car used for this journey.
      */
      public function car()
      {
          return $this->belongsTo('App\Car');
      }

      public function getCarAttribute()
      {
         return Car::find($this->attributes['car_id']);
      }

      public function getUserAttribute()
      {
         return User::find($this->attributes['user_id']);
      }

}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    protected $fillable = [
        'name', 'user_id'
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
        'name' => 'required|string|max:255',
        'user_id' => 'required|numeric',
    ];

    // Relationships

    /**
     * Get the user who created this location.
     */
     public function user()
     {
         return $this->belongsTo('App\User');
     }

}

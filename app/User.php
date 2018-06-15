<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'password', 'role',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static $rules = [
        // Validation rules
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'password' => 'required',
        'role' => 'required',
    ];

    /**
     * Get the cars created by this user.
     */
    public function cars()
    {
        return $this->hasMany('App\Car');
    }

    /**
     * Get the locations created by this user.
     */
    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    /**
     * Get the journeys created by this user.
     */
    public function journeys()
    {
        return $this->hasMany('App\Journey');
    }
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'webpage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //When the user is created
    protected static function booted()
    {
        parent::boot();

        //Add profile once the user is created
        static::created(function($user) {

            $user->profile()->create();
        });
    }

    // One to many relationship 1:n
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    //One to One 1:1 User <-> Profile
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    //Recetas liked for users
    public function meGusta()
    {
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }
}

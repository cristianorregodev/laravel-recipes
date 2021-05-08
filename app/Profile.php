<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //One to One Profile <-> User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

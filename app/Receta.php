<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class Receta extends Model
{
    protected $fillable = [
        'title', 'preparation', 'ingredients', 'image', 'category_id'
    ];

    // Gets the category by FK
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Gets the autor by FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Likes for a receta
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}

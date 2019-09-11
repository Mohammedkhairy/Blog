<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title' , 'content' , 'image' , 'user_id' , 'category_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category' , "category_id");
    }

}

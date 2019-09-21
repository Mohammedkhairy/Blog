<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;

    public $primaryKey = 'id';
	
    protected $casts = [ 'id' => 'string' ];
    
    protected $fillable = ['id' , 'name' , 'code' , 'price' ,'image' , 'description'];

    public static $rules = [
        "name"          => "required|string|max:200",
        "description"   => "required|string|max:200",
        "image"         => "required",
        'price'         => 'required|regex:/^(\d+(,\d{1,2})?)?$/',
        "code"          => "required|alpha_num",
    ];

    public function custom_fields()
    {
        return $this->hasMany('App\Models\CustomFeild' , 'id');
    }
}

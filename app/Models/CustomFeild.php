<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomFeild extends Model
{
    public $incrementing = false;

    public $primaryKey = 'id';
	
    protected $casts = [ 'id' => 'string' ];
    
    protected $fillable = [ 'id' , 'field' , 'description' , 'product_id'];

    public static $rules = [
        "field"         => "required|string",
        "description"   => "required|string",
        "product_id"    => "required",
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product' , 'product_id');
    }
}

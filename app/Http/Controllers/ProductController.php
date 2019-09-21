<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TraitHelperMethods;
use App\Models\Product;

class ProductController extends Controller
{
    
    const MODEL = Product::class;
    const PAGGINATE = 10;
    
    use TraitHelperMethods;
   
}

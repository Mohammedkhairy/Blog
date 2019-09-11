<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TraitHelperMethods;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
  
    const MODEL = Category::class;
    const RELATION = "posts";
    const PAGGINATE = 2;
    use TraitHelperMethods;

}

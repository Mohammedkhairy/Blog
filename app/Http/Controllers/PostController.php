<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TraitHelperMethods;
use Illuminate\Http\Request;
use App\Models\Post;
use Storage;

class PostController extends Controller
{
    
    const MODEL = Post::class;
    const RELATION = "categories";
    const PAGGINATE = 1;
    
    use TraitHelperMethods;
   
}

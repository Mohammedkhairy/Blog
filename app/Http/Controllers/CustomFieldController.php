<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\TraitHelperMethods;
use App\Models\CustomFeild;
use Illuminate\Http\Request;

class CustomFieldController extends Controller
{
    const MODEL = CustomFeild::class;
    const PAGGINATE = 10;
    
    use TraitHelperMethods;

}

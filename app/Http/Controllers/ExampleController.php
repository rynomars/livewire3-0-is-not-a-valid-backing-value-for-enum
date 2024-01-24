<?php

namespace App\Http\Controllers;

use App\Enums\Cheeses;

class ExampleController extends Controller
{
    public function index(Cheeses $cheese)
    {
        echo $cheese->value;
    }
}

<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Drinks extends Controller
{
    public function index()
    {
        return view('content.menus.drinks');
    }
}

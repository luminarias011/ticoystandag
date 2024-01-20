<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Side_dishes extends Controller
{
    public function index()
    {
        return view('content.menus.side_dishes');
    }
}

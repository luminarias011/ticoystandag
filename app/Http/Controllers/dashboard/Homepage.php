<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Homepage extends Controller
{
  public function index()
  {
    $valuee = 99;

    return view('content.dashboard.homepage', [
      'dataFromDatabase' => $valuee,
    ]);
  }

}

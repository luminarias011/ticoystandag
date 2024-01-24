<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function show_hotel_overview()
    {
        // $dailyOverview = $this->generateDailyOverview();
        // $monthlyOverview = $this->generateMonthlyOverview();

        return view('content.hotel.overview');
    }
    
}

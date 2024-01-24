<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use DB;

class SalesOverviewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $dailyOverview = $this->generateDailyOverview();
        $monthlyOverview = $this->generateMonthlyOverview();

        View::share('dailyOverview', $dailyOverview);
        View::share('monthlyOverview', $monthlyOverview);

        Log::info('Sales overviews generated successfully.');
    }

    protected function generateDailyOverview()
    {
        $today = Carbon::today();
        $salesAmount = DB::table('occupied_room')
            ->whereDate('htO_date_paid', $today)
            ->sum('htO_amount_paid');

        // Add your logic for daily overview calculations

        Log::info("Daily Sales Overview for {$today}: {$salesAmount} pesos");
        return ("Daily Sales Overview for {$today}: {$salesAmount} pesos");
    }

    protected function generateMonthlyOverview()
    {
        $thisMonth = Carbon::now()->startOfMonth();
        $salesMonthAmount = DB::table('occupied_room')
            ->whereMonth('htO_date_paid', $thisMonth->month)
            ->sum('htO_amount_paid');

        // Add your logic for monthly overview calculations

        Log::info("Monthly Sales Overview for {$thisMonth->format('F')}: {$salesMonthAmount} pesos");
        return ("Monthly Sales Overview for {$thisMonth->format('F')}: {$salesMonthAmount} pesos");
    }
}

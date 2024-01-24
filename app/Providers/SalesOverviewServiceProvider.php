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
        // $dailyOverview = $this->generateDailyOverview();
        // $monthlyOverview = $this->generateMonthlyOverview();

        // View::share('dailyOverview', $dailyOverview);
        // View::share('monthlyOverview', $monthlyOverview);

        $this->composeDailyOverview();
        $this->composeMonthlyOverview();

        Log::info('Just GENERATE HOURLY!!!!!!!.');
        Log::info('Scheduled task was executed at ' . now());
    }

    //  ! akjfbnqiufbonvbnsieuhvb
    protected function composeDailyOverview()
    {
        view()->composer('*', function ($view) {
            $dailyOverview = $this->generateDailyOverview();
            $view->with('dailyOverview', $dailyOverview);
        });
    }

    protected function composeMonthlyOverview()
    {
        view()->composer('*', function ($view) {
            $monthlyOverview = $this->generateMonthlyOverview();
            $view->with('monthlyOverview', $monthlyOverview);
        });
    }
    //  ! akjfbnqiufbonvbnsieuhvb

    //  ? aosjdnaiufbajkvcn ihb 
    protected function generateDailyOverview()
    {
        $overviews = [];

        // Generate overviews for the last 7 days
        // for ($i = 0; $i < 7; $i++) {
        //     $date = Carbon::today()->subDays($i);
        //     $salesAmount = DB::table('occupied_room')
        //         ->whereDate('htO_date_paid', $date)
        //         ->sum('htO_amount_paid');

        //     $overview[$date->format('Y-m-d')] = ("Daily Sales Overview for {$date->format('F d, Y')}: {$salesAmount} pesos");

        //     Log::info("Daily Sales Overview for {$date->format('F d, Y')}: {$salesAmount} pesos");
        // }
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::today()->subDays($i);
            $salesAmount = DB::table('occupied_room')
                ->whereDate('htO_date_paid', $date)
                ->sum('htO_amount_paid');

            $overview = [
                'dateID' => $date->format('m-d-y'),
                'date' => $date->format('F d, Y'),
                'salesDailyInfo' => ("Daily Sales Overview for {$date->format('F d, Y')}: "),
                'dailyAmount' => $salesAmount
            ];

            $overviews[] = $overview;

            Log::info("Daily Sales Overview for {$date->format('Y-m-d')}: {$salesAmount} pesos");
        }
        
        return $overviews;
    }

    protected function generateMonthlyOverview()
    {
        $overviews = [];

        // for ($i = 0; $i < 12; $i++) {
        //     $date = Carbon::now()->subMonths($i)->startOfMonth();
        //     $salesMonthAmount = DB::table('occupied_room')
        //         ->whereMonth('htO_date_paid', $date->month)
        //         ->sum('htO_amount_paid');

        //     // $overview[$date->format('F Y')] = $salesMonthAmount;
        //     $overview[$date->format('F Y')] = ("Monthly Sales Overview for {$date->format('F Y')}: {$salesMonthAmount} pesos");

        //     Log::info("Monthly Sales Overview for {$date->format('F Y')}: {$salesMonthAmount} pesos");
        // }

        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->subMonths($i)->startOfMonth();
            $salesMonthAmount = DB::table('occupied_room')
                ->whereMonth('htO_date_paid', $date->month)
                ->sum('htO_amount_paid');

            $overview = [
                'monthID' => $date->format('F-m'),
                'month' => $date->format('F Y'),
                'salesMonthlyInfo' => ("Monthly Sales Overview for {$date->format('F Y')}: "),
                'monthlyAmount' => $salesMonthAmount
            ];

            $overviews[] = $overview;

            Log::info("Monthly Sales Overview for {$date->format('F Y')}: {$salesMonthAmount} pesos");
        }
       
        return $overviews;
    }
    //  ? aosjdnaiufbajkvcn ihb 
    
}

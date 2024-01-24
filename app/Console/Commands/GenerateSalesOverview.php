<?php

namespace App\Console\Commands;

use App\Http\Controllers\OverviewController;
use Illuminate\Support\Facades\View;
use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class GenerateSalesOverview extends Command
{
    protected $signature = 'sales:generate-overview';
    protected $description = 'Generate daily and monthly sales overviews';

    public function handle()
    {
        $dailyOverview = $this->generateDailyOverview();
        $monthlyOverview = $this->generateMonthlyOverview();

        View::share('dailyOverview', $dailyOverview);
        View::share('monthlyOverview', $monthlyOverview);

        // View::composer('*', function ($view) use ($dailyOverview, $monthlyOverview) {
        //     $view->with('dailyOverview', $dailyOverview);
        //     $view->with('monthlyOverview', $monthlyOverview);
        // });

        $this->info('Sales overviews BEEEEPPP.');
    }

    protected function generateDailyOverview()
    {
        $today = Carbon::today();
        $salesAmount = DB::table('occupied_room')
            ->whereDate('htO_date_paid', $today)
            ->sum('htO_amount_paid');

        // Add your logic for daily overview calculations

        $this->info("Daily Sales Overview for {$today}: {$salesAmount} pesos");
        return ("Daily Sales Overview for {$today}: {$salesAmount} pesos");
    }

    protected function generateMonthlyOverview()
    {
        $thisMonth = Carbon::now()->startOfMonth();
        $salesMonthAmount = DB::table('occupied_room')
            ->whereMonth('htO_date_paid', $thisMonth->month)
            ->sum('htO_amount_paid');

        // Add your logic for monthly overview calculations

        $this->info("Monthly Sales Overview for {$thisMonth->format('F')}: {$salesMonthAmount} pesos");
        return ("Monthly Sales Overview for {$thisMonth->format('F')}: {$salesMonthAmount} pesos");
    }
    
}

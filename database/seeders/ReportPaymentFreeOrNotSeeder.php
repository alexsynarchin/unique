<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportPaymentFreeOrNotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = Report::with('checkSystem')
            -> chunk(1000, function($reports) {
                foreach ($reports as $report) {
                    if($report->checkSystem -> price > 0 || $report->checkSystem -> price_2 > 0){
                        $report -> payment_free = false;
                        $report -> save();
                    }
                }
            });
    }
}

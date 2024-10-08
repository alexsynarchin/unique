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
        $i = 0;
        Report::with('checkSystem')
            -> chunk(1000, function($reports) use(&$i) {
                foreach ($reports as $report) {
                    if($report->checkSystem -> price  === 0 || $report->checkSystem -> price_2 === 0){
                        $report -> payment_free = true;
                        $report -> save();
                    }

                }
                ++$i;
                echo 'done '. $i . PHP_EOL;
            });
    }
}

<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class NeedPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = Report::all();
        foreach ($reports as $report) {
            if($report->checkSystem->price > 0) {
                $report->need_payment = 1;
            } else {
                $report->need_payment = 0;
            }

            $report->save();
        }
    }
}

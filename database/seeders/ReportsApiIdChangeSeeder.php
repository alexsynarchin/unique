<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportsApiIdChangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = Report::where('system_id', 1)->get();
        foreach ($reports as $report) {
            if(isset($report->data['urls'])) {
                if(isset($report->data['highlight'])) {
                    $report->api_id = 2;
                } else if(isset($report->data['position'])) {
                    $report->api_id = 3;
                } else {
                    $report->api_id = 1;
                }
                $report->save();
            }
        }
    }
}

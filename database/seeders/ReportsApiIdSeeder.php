<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportsApiIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = Report::all(['id', 'system_id', 'api_id']);
        foreach ($reports as $report) {
            $report -> api_id = $report->checkSystem->api_id;
            $report->save();
        }
    }
}

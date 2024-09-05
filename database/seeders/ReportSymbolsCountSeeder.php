<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSymbolsCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
         Report::select('id', 'system_id', 'api_id', 'check_unique_id', 'symbols_count')
            ->with('checkSystem', function ($q){
                $q->select('id','symbols_count', 'created_at');
            })
            ->with('checkUnique', function ($q){
                $q->select('id','symbolsCount', 'created_at');
            })
            ->chunk(1000, function($reports) use (&$i){
                foreach($reports as $report){
                    $report ->symbols_count = $report ->checkUnique -> symbolsCount;
                    if($report -> checkUnique -> symbolsCount > $report -> checkSystem -> symbols_count) {
                        $report->symbols_count = $report -> checkSystem -> symbols_count;
                    }
                    $report ->save();
                }
                ++$i;
                echo 'done '. $i .PHP_EOL;
            });

    }
}

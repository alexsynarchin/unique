<?php

namespace Database\Seeders;

use App\Models\CheckUnique;
use Illuminate\Database\Seeder;

class CheckUniqueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_uniques = CheckUnique::with('reports.checkSystem')->get();

        foreach ($check_uniques as $check_unique) {
            $check_unique_types = [
                'manual' => false,
                'auto' => false,
            ];
            foreach ($check_unique->reports as $report) {
                if($report->checkSystem->manual) {
                    if(!$check_unique_types['manual']) {
                        $check_unique_types['manual'] = true;
                    }
                } else {
                    if(!$check_unique_types['auto']) {
                        $check_unique_types['auto'] = true;
                    }
                }
            }

            if($check_unique_types['auto'] && !$check_unique_types['manual']) {
                $check_unique->type = 1;
            } else if(!$check_unique_types['auto'] && $check_unique_types['manual']) {
                $check_unique->type = 2;
            } else if($check_unique_types['auto'] && $check_unique_types['manual']) {
                $check_unique -> type = 3;
            }
            $check_unique->save();
        }


    }
}

<?php

namespace Database\Seeders;

use App\Models\CheckUnique;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $check_uniques = CheckUnique::all();
        foreach ($check_uniques as $check_unique) {
            if(!$check_unique-> slug) {
                $check_unique->slug = Str::random(32);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\CheckApi;
use Illuminate\Database\Seeder;

class CheckApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $api_list = [
            [
              'title' => 'text.ru'
            ],
            [
                'title' => 'content-watch.ru'
            ],
        ];
        foreach ($api_list as $api_item) {
            CheckApi::create($api_item);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
class CreatePagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'title' => 'home',
                'slug' => ''
            ],
            [
                'title' => 'Стоимость',
                'slug' => 'price'
            ],
            [
                'title' => 'Вопросы и ответы',
                'slug' => 'faq'
            ],
            [
                'title' => 'Отзывы',
                'slug' => 'reviews'
            ],
            [
                'title' => 'О компании',
                'slug' => 'about'
            ],
            [
                'title' => 'О компании',
                'slug' => 'about'
            ],
            [
                'title' => 'Cтатьи',
                'slug' => 'articles'
            ],
        ];
        foreach ($pages as $page) {
            $page = Page::firstOrCreate($page);
            $page -> seo() ->create();
        }
    }
}

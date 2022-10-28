<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Просмотр "Системы проверки"']);
        Permission::create(['name' => 'Просмотр "Запросы на проверку"']);
        Permission::create(['name' => 'Просмотр "Дополнительные услуги"']);
        Permission::create(['name' => 'Просмотр "Заявки на рерайт"']);
        Permission::create(['name' => 'Просмотр "Модераторы"']);
        Permission::create(['name' => 'Просмотр "Промокоды"']);
        Permission::create(['name' => 'Просмотр "Заявки"']);
        Permission::create(['name' => 'Просмотр "Главная страница"']);
        Permission::create(['name' => 'Просмотр "Стоимость"']);
        Permission::create(['name' => 'Просмотр "Вопросы и ответы"']);
        Permission::create(['name' => 'Просмотр "Отзывы"']);
        Permission::create(['name' => 'Просмотр "О проекте"']);
        Permission::create(['name' => 'Просмотр "Статические страницы"']);
        Permission::create(['name' => 'Просмотр "Статьи"']);
        Permission::create(['name' => 'Просмотр "Настройки"']);
    }
}

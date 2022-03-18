<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $data = [
            'name' => 'Администратор',
            'email' => 'admin@unique.ru',
            'password'=> Hash::make('1q23ty3io')
        ];
        $admin= User::create($data);
        $admin->assignRole($role);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChangeAdminPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::findOrFail(1);
        //1q23ty3ioy6679
        //1q23ty3io
        $admin->password = Hash::make('1q23ty3ioy6679');
        $admin->save();
    }
}

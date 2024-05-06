<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User([
            'number_id' => '1193215590',
            'name' => 'stiven',
            'last_name' => 'colorado',
            'email' => 'stivenchoo@gmail.com',
            'password' => '123456789',
            'remember_token' => Str::random(10)
        ]);
        $user->save();
        $user->assignRole('admin');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
[
    'name'=>'admin karir',
    'email'=>'admin@gmail.com',
    'role'=>'admin',
    'password'=>bcrypt('admin123')
],
        ];
        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\karir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KarirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            karir::create([
                'job_title'=>$faker->jobTitle,
                'description'=>$faker->paragraph,
                'location'=>$faker->city,
            ]);
        }
    }
}

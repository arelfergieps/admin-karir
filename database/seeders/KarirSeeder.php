<?php

namespace Database\Seeders;

use App\Models\Karir;
use Illuminate\Database\Seeder;

class KarirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            Karir::create([
                'job_title' => $faker->jobTitle,
                'description' => $faker->paragraph,
                'location' => $faker->city,
                'kategori' => $faker->randomElement(['Teknologi', 'Keuangan', 'Pendidikan', 'Kesehatan']),
                'kualifikasi' => $faker->sentence,
                'divisi' => $faker->randomElement(['IT', 'HRD', 'Finance', 'Marketing']),
                'gaji' => $faker->numberBetween(4000000, 10000000), // Gaji dalam range
                'status' => $faker->randomElement([1, 2]) // 1 untuk show, 2 untuk hide
            ]);
        }
    }
}

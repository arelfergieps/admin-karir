<?php

namespace Database\Seeders;

use App\Models\Apply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            Apply::create([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,  // Menghasilkan email unik dan valid
                'no_tlp' => $faker->phoneNumber,         // Menghasilkan nomor telepon yang valid
                'alamat' => $faker->address,             // Menghasilkan alamat yang valid
                'cv' => 'path/to/cv/' . $faker->uuid . '.pdf',  // Menghasilkan path atau nama file CV
                'portofolio' => $faker->url,
            ]);
        }
    }

}

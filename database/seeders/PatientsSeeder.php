<?php

namespace Database\Seeders;

use App\Models\PatientsModel;
use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

    public function run()
    {
        PatientsModel::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            PatientsModel::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'patient_code' => $faker->regexify('[A-Za-z0-9]{20}'),
                'address' => $faker->name, // secret
            ]);
        }

    }
}

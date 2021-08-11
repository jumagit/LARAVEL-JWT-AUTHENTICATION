<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\PatientsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PatientsModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

   
    public function definition()
    {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'patient_code' => str_random(60),
            'addess' => $faker->name, // secret
          
        ];
    }
}

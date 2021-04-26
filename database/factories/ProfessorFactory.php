<?php

namespace Database\Factories;

use App\Models\Professor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Professor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'name' => "Salah Krit",
          'email' => "salah@gmail.com",
          'password' => Hash::make('123456'),
        ];
    }
}

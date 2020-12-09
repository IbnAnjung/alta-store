<?php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Guest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
           
        return [
            'token' => substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdef1234567890'),1,16),
            'created_at' => date("Y-m-d H:i:s")
        ];
    }
}

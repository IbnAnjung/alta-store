<?php

namespace Database\Factories;

use App\Models\Checkout;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckoutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Checkout::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'guest_id' => Guest::factory(),
        'address' => $this->faker->address,
        'city' => $this->faker->city,
        'phone' => $this->faker->e164PhoneNumber,
        'created_at' => date("Y-m-d H:i:s")
      ];
    }
}

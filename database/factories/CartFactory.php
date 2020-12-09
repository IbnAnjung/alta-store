<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'guest_id' => Guest::factory(),
        'created_at' => date("Y-m-d H:i:s")
      ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'name' => $this->faker->sentence(rand(3, 5)),
        'category_id' => Category::factory(),
        'price' => rand(100000, 3000000),
        'weight' => rand(1,2),
        'description' => $this->faker->words(10, true),
        'created_at' => date("Y-m-d H:i:s")
      ];
    }
}

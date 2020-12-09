<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Checkout;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

      return [
        'checkout_id' => Checkout::factory(),
        'number' => date("Y") . sprintf("%02d", rand(1, 12)) . sprintf("%02d", rand(1, 29)) . sprintf("%04d", rand(10, 1000), 4),
        'created_at' => date("Y-m-d H:i:s")
      ];
    }
}

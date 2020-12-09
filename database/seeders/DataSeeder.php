<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Invoice;

class DataSeeder extends Seeder
{

  /**
   * run databse seeds
   * 
   * @return void
   */
  public function run()
  {

    Category::factory()
      ->times(15)
      ->has(
        Product::factory()
        ->count(15)
        ->hasAttached(
          Cart::factory()
            ->count(1)
            ->hasGuest(1),
            [
              "qty" => rand(1, 10),
            ]
        )
        ->hasAttached(
          Checkout::factory()
            ->count(2)
            ->hasGuest(1)
            ->hasInvoice(1),
            [
              "qty" => rand(1, 10),
              "price" => rand(10000, 3000000),
              "weight" => rand(1, 20),
              "description" => "ini deskripsi barang saat masuk ke dalam checkout"
            ]
        )
      )
      ->create();

  }

}
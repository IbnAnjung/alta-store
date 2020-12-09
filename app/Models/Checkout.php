<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{

  use HasFactory;

  /**
   * many to many with product
   * 
   * @return Eloquent
   */
  public function products()
  {

    return $this->belongsToMany(Product::class)
      ->withPivot([
        'qty',
        'price',
        'weight',
        'description'
      ]);

  }

  /**
   * one to one invers with guest
   * 
   * @return Eloquent 
   */
  public function guest()
  {

    return $this->belongsTo(Guest::class);

  }

  /**
   * one to one with invoices
   * 
   * @return Eloquent
   */
  public function invoice()
  {

    return $this->hasOne(Invoice::class);

  }

}
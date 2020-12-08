<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{

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
  public function invoince()
  {

    return $this->hasOne(Invoice::class);

  }

}
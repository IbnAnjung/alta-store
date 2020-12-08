<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{

  /**
   * one to many chekout
   * 
   * @return Eloquent
   */
  public function checkouts()
  {

    return $this->hasMany(Checkout::class);

  }

  /**
   * one to one cart
   * 
   * @return Eloquent
   */
  public function cart()
  {

    return $this->hasOne(Cart::class);

  }



}
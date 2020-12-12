<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

  protected $table="payment_confirmation";
  
  /**
   * one to one invers with checkout
   * 
   * @return Eloquent 
   */
  public function checkout()
  {

    return $this->belongsTo(Checkout::class);

  }

}
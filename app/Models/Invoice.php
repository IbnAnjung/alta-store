<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

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